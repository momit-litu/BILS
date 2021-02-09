<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Session;
use DB;
use App\Traits\HasPermission;
use Illuminate\Http\Request;

use App\Publication;
use App\Notification;
use App\UserGroup;
use App\AppUser;
use App\AppUserGroupMember;
use App\PublicationCategory;

class PublicationController extends Controller
{
    use HasPermission;

    public function __construct(Request $request)
    {
        $this->page_title = $request->route()->getName();
        $description = \Request::route()->getAction();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    public function index(){
    	$data['page_title'] = $this->page_title;
		$data['module_name']= "Publication";
		$data['sub_module']= "";
		//action permissions
		$admin_user_id 		   = Auth::user()->id;
		$add_action_id 	   	   = 65;
		$add_permisiion 	   = $this->PermissionHasOrNot($admin_user_id,$add_action_id );
		$data['actions']['add_permisiion']= $add_permisiion;

        return view('publication.index', $data);
    }

    //Publication Entry And Update
    public function publicationEntry(Request $request){
		$rule = [
            'publication_title' => 'Required|max:150',
            'details' => 'Required',
        ];

        $validation = Validator::make($request->all(), $rule);
        if ($validation->fails()) {
			$return['result'] = "0";
			$return['errors'] = $validation->errors();
			return json_encode($return);
        }
		else{
			/*----- For notification -----*/
			$app_user_group = $request->input('app_user_group');


			$from_id = Auth::user()->id;
			$from_user_type = 'Admin';
			$to_user_type = 'App User';
			$publication_title = $request->publication_title;
			$message = $request->details;
			/*----- For notification -----*/

            $attachment = $request->file('attachment');
            if($request->hasFile('attachment')) {

                $upload_path = 'assets/attachment/publications/';
                $attachment_name = rand().time().$attachment->getClientOriginalName();
                //return $attachment_name;
                $success=$attachment->move($upload_path,$attachment_name);
            }else{
                $attachment_name = '';

            }


			try{
				DB::beginTransaction();
				$status = ($request->is_active =="")?'0':'1';

				if ($request->publication_edit_id == '') {
					$created_by = Auth::user()->name;
					$column_value = [
						'publication_title'=>$request->publication_title,
						'details'=>$request->details,
						'publication_type'=>$request->publication_type,
						'authors'=>$request->authors,
						'status'=>$status,
						'created_by'=>$created_by,
                        'attachment'=>$attachment_name,

                    ];
					$response = Publication::create($column_value);
					$publication_id = $response->id;
					$view_url = 'publication/'.$publication_id;

					## Insert Into Notification
				}
				else{
					$updated_by = Auth::user()->name;
					$column_value = [
						'publication_title'=>$request->publication_title,
						'details'=>$request->details,
						'publication_type'=>$request->publication_type,
						'authors'=>$request->authors,
						'status'=>$status,
						'updated_by'=>$updated_by,
					];

                    if($attachment_name!=''){
                        $column_value['attachment']=$attachment_name;
                    }
					$data = Publication::find($request->publication_edit_id);
                    $publication_id = $request->publication_edit_id;
					$data->update($column_value);
				}

                if (isset($app_user_id)&&isset($app_user_name)&&$app_user_id!=""&&$app_user_name!="") {

                    $to_id = $app_user_id;

                    $isNotification = Notification::where([['to_id',$to_id],['module_id',38],['module_reference_id',$publication_id]])->get();

                    if(sizeof($isNotification)==0){
                        //return $to_id;
                        $column_value = [
                            'from_id'=>$from_id,
                            'from_user_type'=>$from_user_type,
                            'to_id'=>$to_id,
                            'to_user_type'=>$to_user_type,
                            'notification_title'=>$publication_title,
                            'message'=>$message,
                            'view_url'=>'publication/'.$publication_id,
                            'module_id'=>38,
                            'module_reference_id'=>$publication_id,
                        ];
                        $response = Notification::create($column_value);
                        //return $to_id;
                    }
                }

                if(isset($app_users)&& $app_users!="" && $app_users!=null ){

                    foreach ($app_users as $j) {
                        $isNotification = Notification::where([['to_id',$j],['module_id',38],['module_reference_id',$publication_id]])->get();

                        if(sizeof($isNotification)==0){
                            $column_value = [
                                'from_id'=>$from_id,
                                'from_user_type'=>$from_user_type,
                                'to_id'=>$j,
                                'to_user_type'=>$to_user_type,
                                'notification_title'=>$publication_title,
                                'message'=>$message,
                                'view_url'=>'publication/'.$publication_id,
                                'module_id'=>38,
                                'module_reference_id'=>$publication_id,
                            ];
                            $response = Notification::create($column_value);
                        }
                    }
                }
                else if (isset($app_user_group)&& $app_user_group!="") {

                    foreach ($app_user_group as $group) {
                        $appUsers = AppUserGroupMember::where([['group_id', $group], ['status', '=', 1]])->get();

                        foreach ($appUsers as $j) {
                            $isNotification = Notification::where([['to_id', $j['app_user_id']], ['module_id', 38], ['module_reference_id', $publication_id]])->get();

                            if (sizeof($isNotification) == 0) {
                                //return json_encode($isNotification);

                                $column_value = [
                                    'from_id' => $from_id,
                                    'from_user_type' => $from_user_type,
                                    'to_id' => $j['app_user_id'],
                                    'to_user_type' => $to_user_type,
                                    'notification_title' => $publication_title,
                                    'message' => $message,
                                    'view_url' => 'publication/' . $publication_id,
                                    'module_id' => 38,
                                    'module_reference_id' => $publication_id,
                                ];
                                $response = Notification::create($column_value);
                            }

                        }
                    }
                }





                DB::commit();
				$return['result'] = "1";
				return json_encode($return);
			}
			catch (\Exception $e){
				DB::rollback();
				$return['result'] = "0";
				$return['errors'][] ="Faild to save";
				return json_encode($return);
			}
		}
	}

	//Publication List
	public function publicationList(){

		$admin_user_id 		= Auth::user()->id;
		$edit_action_id 	= 70;
		$delete_action_id 	= 71;
		$edit_permisiion 	= $this->PermissionHasOrNot($admin_user_id,$edit_action_id);
		$delete_permisiion 	= $this->PermissionHasOrNot($admin_user_id,$delete_action_id);

		$publication_list = Publication::Select('id', 'publication_title', 'details', 'publication_type', 'authors', 'status')
						->orderBy('id','desc')
						->get();
		$return_arr = array();
		foreach($publication_list as $data){
			$data['status']=($data->status == 1)?"<button class='btn btn-xs btn-success' disabled>Active</button>":"<button  class='btn btn-xs btn-danger' disabled>In-active</button>";

			$data['actions']=" <button title='View' onclick='publication_view(".$data->id.")' id='view_" . $data->id . "' class='btn btn-xs btn-primary' ><i class='clip-zoom-in'></i></button>";

			if($edit_permisiion>0){
				$data['actions'] .=" <button title='Edit' onclick='edit_publication(".$data->id.")' id=edit_" . $data->id . "  class='btn btn-xs btn-green' ><i class='clip-pencil-3'></i></button>";
			}
			if ($delete_permisiion>0) {
				$data['actions'] .=" <button title='Delete' onclick='delete_publication(".$data->id.")' id='delete_" . $data->id . "' class='btn btn-xs btn-danger' ><i class='clip-remove'></i></button>";
			}
			$return_arr[] = $data;
		}
		return json_encode(array('data'=>$return_arr));
	}

	//Publication view
	public function publicationView($id){
    	$data = Publication::find($id);
		return json_encode($data);
    }

    //Publication Delete
    public function publicationDelete($id){
		Publication::find($id)->delete();
		return json_encode(array(
			"deleteMessage"=>"Deleted Successful"
		));
	}
	//Publication category
	public function publicationTypeList(){
		//$data = PublicationCategory::where('status','1')->get();
		$data = DB::table('publication_categories')
            ->where ('status',1)
            ->select('id', DB::raw(
                'concat(category_name," ",ifnull(category_name_bn,"")) as category_name'
            ))
            ->get();

		return json_encode($data);
	}

	//Publication edit data
	public function publicationEdit($id){
		$data = Publication::find($id);
		return json_encode($data);
	}





}
