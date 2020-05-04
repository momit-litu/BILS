<?php

namespace App\Http\Controllers;

use App\UserGroup;
use Auth;
use Validator;
use Session;
use DB;
use App\Traits\HasPermission;
use Illuminate\Http\Request;

use \App\System;
use \App\Setting;
use App\Menu;
use App\MessageMaster;
use App\AppUserGroupMember;
use App\AppUser;
use App\MessageAttachment;
use App\MessageCategory;


class MessageController extends Controller
{
    use HasPermission;

	public function __construct(Request $request)
    {
        $this->page_title = $request->route()->getName();
        $description = \Request::route()->getAction();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    public function all_messages(){
    	$data['page_title'] = $this->page_title;
		$data['module_name']= "Messages";
		$data['sub_module']= "All Messages";
		return view('message.all_messages',$data);
    }

    public function categoryMessages(){
        $data['page_title'] = $this->page_title;
        $data['module_name']= "Messages";
        $data['sub_module']= "All Messages";
        return view('message.category_messages',$data);
    }

    public function sentMessageManage(){
        $data['page_title'] = $this->page_title;
        $data['module_name']= "Messages";
        $data['sub_module']= "Sent Message";
        //action permissions
        $admin_user_id         = Auth::user()->id;
        $add_action_id         = 73;
        $add_permisiion        = $this->PermissionHasOrNot($admin_user_id,$add_action_id );
        $data['actions']['add_permisiion']= $add_permisiion;
        return view('message.sent_message_manage',$data);
    }

    //Message Entry And Update
    public function messageEntry(Request $request){
        $rule = [
            'admin_message' => 'Required',
        ];

        $validation = Validator::make($request->all(), $rule);
        if ($validation->fails()) {
            $return['result'] = "0";
            $return['errors'] = $validation->errors();
            return json_encode($return);
        }
        else{

            try{
                DB::beginTransaction();
                $is_active = ($request->is_active=="")?"0":"1";

                 $admin_id = Auth::user()->id;


                if ($request->message_edit_id == '') {

                    $message_id = MessageMaster::select('message_id')->where('message_id', '!=',null)->orderBy('id','desc')->first();

                    if ($message_id['message_id']=="") {
                        $message_id = 1;
                    }
                    else{
                        $message_id = $message_id['message_id']+1;
                    }

                    $app_user_group = $request->input('app_user_group');
                    $app_users = $request->input('app_users');

                    //return json_encode($app_users);
                    if(isset($app_users)&& $app_users!="" && $app_users!=null ){
                        var_dump (json_encode($app_users));
                        foreach ($app_users as $j) {
                            $old_msg = MessageMaster::select('id')->where('message_id', $message_id)->where('app_user_id', $j)->count();
                            if ($old_msg==0) {
                                $app_user_id = $j;
                                $column_value = [
                                    'admin_message'=>$request->admin_message,
                                    'admin_id'=>$admin_id,
                                    'app_user_id'=>$app_user_id,
                                    'message_id'=>$message_id,
                                    'status'=>$is_active,
                                    'message_category'=>$request->message_category,
                                ];
                                $response = MessageMaster::create($column_value);
                            }
                        }
                    }
                    else if (isset($app_user_group)&& $app_user_group!="") {

                        foreach ($app_user_group as $row) {

                                $column_value = [
                                    'admin_message'=>$request->admin_message,
                                    'admin_id'=>$admin_id,
                                    'group_id'=>$row,
                                    'is_group_msg'=>1,
                                    'message_id'=>$message_id,
                                    'status'=>$is_active,
                                    'message_category'=>$request->message_category,
                                ];
                                $response = MessageMaster::create($column_value);

                            }
                    }

                    if(isset($request->app_user_id)){
                        $column_value = [
                            'admin_message'=>$request->admin_message,
                            'admin_id'=>$admin_id,
                            'app_user_id'=>$request->app_user_id,
                            'message_id'=>$message_id,
                            'status'=>$is_active,
                            'message_category'=>$request->message_category,
                        ];
                        $response = MessageMaster::create($column_value);
                    }


                }
                // else if($request->message_edit_id != ''){
                //     $data = User::find($request->id);
                //     $data->update($column_value);

                // }
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


    //Message List
    public function messageList(){

        $admin_user_id      = Auth::user()->id;
        $edit_action_id     = 74;
        $delete_action_id   = 75;
        $edit_permisiion    = $this->PermissionHasOrNot($admin_user_id,$edit_action_id);
        $delete_permisiion  = $this->PermissionHasOrNot($admin_user_id,$delete_action_id);

		/*echo MessageMaster::Select('id', 'admin_message', 'app_user_id', 'is_seen', 'status', 'message_category')
						->distinct('message_id')
						->whereNotNull('message_id')
                        ->orderBy('message_id','desc')
                        ->toSql();die;*/

        $message_list = MessageMaster::Select('id', 'admin_message', 'app_user_id', 'is_seen', 'status', 'message_category')
						->distinct('message_id')
						->whereNotNull('message_id')
                        ->orderBy('message_id','desc')
						->groupBy('message_id')
                        ->get();

        $return_arr = array();
        foreach($message_list as $data){
            $message_category = MessageCategory::select('category_name')->where('id',$data->message_category)->first();

            $data['message_category'] = $message_category['category_name'];

            $app_user_name = AppUser::select('name')->where('id', $data->app_user_id)->first();

            $data['app_user_name'] = $app_user_name['name'];

            $data['is_seen']=($data->is_seen == 1)?"<button class='btn btn-xs btn-success' disabled>Seen</button>":"<button  class='btn btn-xs btn-danger' disabled>Not-seen</button>";

            if ($data->status==0) {
                $data['status'] = "<button class='btn btn-xs btn-warning' disabled>In-active</button>";
            }
            else if($data->status==1){
                 $data['status'] = "<button class='btn btn-xs btn-success' disabled>Active</button>";
            }
            else if($data->status==2){
                 $data['status'] = "<button class='btn btn-xs btn-danger' disabled>Deleted</button>";
            }

            $data['actions']=" <button title='View' onclick='message_view(".$data->id.")' id='view_" . $data->id . "' class='btn btn-xs btn-primary' ><i class='clip-zoom-in'></i></button>";

            if($edit_permisiion>0){
                $data['actions'] .=" <button title='Edit' onclick='edit_message(".$data->id.")' id=edit_" . $data->id . "  class='btn btn-xs btn-green' ><i class='clip-pencil-3'></i></button>";
            }
            if ($delete_permisiion>0) {
                $data['actions'] .=" <button title='Delete' onclick='delete_message(".$data->id.")' id='delete_" . $data->id . "' class='btn btn-xs btn-danger' ><i class='clip-remove'></i></button>";
            }
            $return_arr[] = $data;
        }
        return json_encode(array('data'=>$return_arr));
    }


    //Message view
    public function messageView($id){
        $data = MessageMaster::find($id);
        return json_encode($data);
    }


    //Message Delete
    public function messageDelete($id){
        MessageMaster::find($id)->delete();
        return json_encode(array(
            "deleteMessage"=>"Deleted Successful"
        ));
    }


    ## Load app user for message
    public function loadAppUser(){

        //$app_user = AppUser::get();
		/*echo DB::table('message_masters as mm')
                            ->rightJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                            ->where('is_group_msg', 0)
                            ->select('apu.name as name','apu.id as app_user_id', 'apu.user_profile_image as user_profile_image')
                            ->distinct('mm.app_user_id')
                            //->orderBy('mm.message_date_time', 'desc')
                            ->orderBy('mm.id', 'desc')
							->toSql();die;*/
        $app_user_info = DB::table('message_masters as mm')
                            ->rightJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                           // ->where('is_group_msg', 0)
                            ->select('apu.name as name','apu.id as app_user_id', 'apu.user_profile_image as user_profile_image')
                            ->distinct('mm.app_user_id')
                            //->orderBy('mm.message_date_time', 'desc')
                            ->orderBy('mm.id', 'desc')
                            ->get();

        return json_encode(array(
            "app_user_info"=>$app_user_info,
            // "message"=>$message,
        ));
    }


     ## Load app user message app_user_id
    public function loadMessage(){
        $app_user_id_load_msg 	= $_POST['app_user_id_load_msg'];
		$page_no 				= $_POST['page_no'];
		$limit 					= $_POST['limit'];
		$message_load_type		= $_POST['message_load_type'];
		$last_appuser_message_id= $_POST['last_appuser_message_id'];
		$start = ($page_no*$limit)-$limit;
		$end   = $limit;
		$message = array();
		/*echo DB::table('message_masters as mm')
				->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
				->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
				->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
				->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
				->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
				->where('mm.app_user_id',$app_user_id_load_msg)
				->where(function ($query) {
					$query->whereNotNull('mm.app_user_message')
					->orWhere('mm.is_attachment_app_user', '>', 0);
				})
				->where('mm.status','!=',0)
				->where('mm.id','>',$last_appuser_message_id)
				->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
				DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
				DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
				'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
				->groupBy('id')
				->orderBy('mm.message_date_time', 'desc')
                            ->toSql();die;*/
        if($message_load_type ==1 || $message_load_type ==3){
			$message = DB::table('message_masters as mm')
                    ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                    ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
                    ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
                    ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
					->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                    ->where('mm.app_user_id',$app_user_id_load_msg)
                    ->where('mm.status','!=',0)
                    ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
                    ->groupBy('id')
                    ->orderBy('mm.message_date_time', 'desc')
					->offset($start)
                    ->limit($end)
                    ->get();
		}
		else if($message_load_type==2){
			$message = DB::table('message_masters as mm')
				->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
				->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
				->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
				->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
				->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
				->where('mm.app_user_id',$app_user_id_load_msg)
				->where(function ($query) {
					$query->whereNotNull('mm.admin_message')
					->orWhere('mm.is_attachment', '>', 0);
				})
				->where('mm.status','!=',0)
				->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
				DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
				DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
				'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
				->groupBy('id')
				->orderBy('mm.message_date_time', 'desc')
				->limit(1)
				->get();
		}
		else if($message_load_type==4){
			$message = DB::table('message_masters as mm')
				->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
				->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
				->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
				->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
				->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
				->where('mm.app_user_id',$app_user_id_load_msg)
				->where(function ($query) {
					$query->whereNotNull('mm.app_user_message')
					->orWhere('mm.is_attachment_app_user', '>', 0);
				})
				->where('mm.status','!=',0)
				->where('mm.id','>',$last_appuser_message_id)
				->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
				DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
				DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
				'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
				->groupBy('id')
				->orderBy('mm.message_date_time', 'desc')
				->get();
		}

        return json_encode(array(
            "message"=>$message
        ));
    }



    ##Search APP Users
    public function searchAppUsers(){
        $search_app_user_name = $_POST['name'];
        $app_users = AppUser::select('id', 'name','user_profile_image')
                    ->where('name','like', '%'.$search_app_user_name.'%')
                    ->orwhere('contact_no','like', '%'.$search_app_user_name.'%')
                    ->orwhere('email','like', '%'.$search_app_user_name.'%')
                    ->get();
        return json_encode($app_users);
    }

    public function searchMessageCategory($category){
        $data = MessageCategory::select('id', 'category_name')
            ->where('category_name','like', '%' . $category . '%')
            ->get();
        return json_encode($data);

    }


    public function newMsgSent(Request $r){
        if($r->message_category==''){
            $msg_cat = $r->category_id;
        }
        else{
            $msg_cat = $r->message_category;
		//edit_msg_id
        }
        if(isset($r->reply_msg_id)){
            $reply_to = $r->reply_msg_id;
        }else{
            $reply_to = null;
        }
        $app_user_id = $r->app_user_id;
        $admin_message = $r->admin_message;
        $message_category = $msg_cat;
        $admin_id = Auth::user()->id;
        ## Image
        $attachment = $r->file('attachment');
		if(isset($r->edit_msg_id) && $r->edit_msg_id>0){
			MessageMaster::where('id',$r->edit_msg_id)->update(['admin_message'=>$admin_message]);
			if($r->hasFile('attachment')){
				foreach ($attachment as $attachment) {
					$attachment_name = rand().time().$attachment->getClientOriginalName();
					$ext = strtoupper($attachment->getClientOriginalExtension());
					echo $ext;
					if ($ext=="JPG" || $ext=="JPEG" || $ext=="PNG" || $ext=="GIF" || $ext=="WEBP" || $ext=="TIFF" || $ext=="PSD" || $ext=="RAW" || $ext=="INDD" || $ext=="SVG") {
						$attachment_type = 1;
					}
					else if ($ext=="MP4" || $ext=="3GP") {
						$attachment_type = 2;
					}
					else if ($ext=="MP3") {
						$attachment_type = 3;
					}
					else{
						$attachment_type = 4;
					}
					//$attachment_full_name = $attachment_name.'.'.$ext;
					$upload_path = 'assets/images/message/';

					$success=$attachment->move($upload_path,$attachment_name);
					if($success) MessageMaster::where('id',$r->edit_msg_id)->update(['is_attachment'=>1]);
					##Save image to the message attachment table
					$msg_attachment = new MessageAttachment();
					$msg_attachment->message_master_id = $r->edit_msg_id;
					$msg_attachment->admin_atachment = $attachment_name;
					$msg_attachment->attachment_type = $attachment_type;
					$msg_attachment->save();
				}
			}
			return 1;
		}
		else{
			$new_msg = new MessageMaster();
			$new_msg->admin_id = $admin_id;
			$new_msg->admin_message = $admin_message;
			$new_msg->message_category = $message_category;
			$new_msg->app_user_id = $app_user_id;
			$new_msg->reply_to = $reply_to;
			$new_msg->save();
			$mm_id = $new_msg->id;

			if($r->hasFile('attachment')){
				foreach ($attachment as $attachment) {
					$attachment_name = rand().time().$attachment->getClientOriginalName();
					$ext = strtoupper($attachment->getClientOriginalExtension());
					echo $ext;
					if ($ext=="JPG" || $ext=="JPEG" || $ext=="PNG" || $ext=="GIF" || $ext=="WEBP" || $ext=="TIFF" || $ext=="PSD" || $ext=="RAW" || $ext=="INDD" || $ext=="SVG") {
						$attachment_type = 1;
					}
					else if ($ext=="MP4" || $ext=="3GP") {
						$attachment_type = 2;
					}
					else if ($ext=="MP3") {
						$attachment_type = 3;
					}
					else{
						$attachment_type = 4;
					}
					//$attachment_full_name = $attachment_name.'.'.$ext;
					$upload_path = 'assets/images/message/';

					$success=$attachment->move($upload_path,$attachment_name);
					if($success) MessageMaster::where('id',$mm_id)->update(['is_attachment'=>1]);

					##Save image to the message attachment table
					$msg_attachment = new MessageAttachment();
					$msg_attachment->message_master_id = $mm_id;
					$msg_attachment->admin_atachment = $attachment_name;
					$msg_attachment->attachment_type = $attachment_type;
					$msg_attachment->save();
				}
			}
			return $mm_id;
		}
    }

    public function deleteMessage($id){
        MessageMaster::where('id',$id)->update(['status'=>0]);
        return 1;
    }

    public function getMessageCategory(){
        $data = MessageCategory::select('id', 'category_name')->get();
        return json_encode($data);
    }

    public function loadAppUserFromGroup(Request $r){
        $group = $r->app_user_group;
        $a = array();
        foreach($group as $group){
            // $data = AppUserGroupMember::select('app_user_id')->where('status',1)->whereIn('group_id',[$group])->get();
            $data = DB::table('app_user_group_members as a')
                    ->leftJoin('app_users as b', 'a.app_user_id', '=', 'b.id')
                    ->select('a.app_user_id as app_user_id', 'b.name as name')
                    ->where('a.status',1)
                    ->whereIn('a.group_id',[$group])
                    ->get();
            $a[]=$data;
        }
        return json_encode($a);
    }


    public function groupMessageManagement(){
        $data['page_title'] = $this->page_title;
        $data['module_name']= "Messages";
        $data['sub_module']= "Group Messages";
        return view('message.group_message',$data);
    }


    Public function loadAppUserGroup(){

        $app_user_info = UserGroup::select('group_name', 'id')->get();

        // DB::table('message_masters as mm')
        //                     ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
        //                     ->select('apu.name as name','apu.id as app_user_id', 'apu.user_profile_image as user_profile_image')
        //                     ->distinct('mm.app_user_id')
        //                     //->orderBy('mm.message_date_time', 'desc')
        //                     ->orderBy('mm.id', 'desc')
        //                     ->get();

        return json_encode(array(
            "app_user_info"=>$app_user_info,
            // "message"=>$message,
        ));
    }

    ##Search APP Users Group
    public function searchAppUsersGroup(){
        $group_name = $_POST['group_name'];
        $app_users = UserGroup::select('id', 'group_name')
                    ->where('group_name','like', '%'.$group_name.'%')
                    ->get();
        return json_encode($app_users);
    }


    public function newGroupMessageSent(Request $r){

	    if(isset($r->edit_msg_id) && $r->edit_msg_id>0){
	        return MessageMaster::where('id',$r->edit_msg_id)->update(['admin_message'=>$r->admin_message]);
        }
	    //return $r->group_id;
        $group_id = $r->group_id;
        $category_id = $r->message_category;
        $admin_message = $r->admin_message;
        //$message_category = $r->message_category;
        $admin_id = Auth::user()->id;
        ## Image
        $attachment = $r->file('attachment');
        $reply_to = null;
        if(isset($r->reply_msg_id) && $r->reply_msg_id>0){
            $reply_to = $r->reply_msg_id;
        }

        if($r->hasFile('attachment')){
            $new_msg = new MessageMaster();
            $new_msg->admin_id = $admin_id;
            $new_msg->admin_message = $admin_message;
            $new_msg->message_category = $category_id;
            $new_msg->group_id = $group_id;
            $new_msg->is_group_msg = 1;
            $new_msg->is_attachment = 1;
            $new_msg->reply_to = $reply_to;
            $new_msg->save();
            $mm_id = $new_msg->id;


            foreach ($attachment as $attachment) {
                $attachment_name = rand().time().$attachment->getClientOriginalName();
                $ext = strtoupper($attachment->getClientOriginalExtension());
                echo $ext;
                if ($ext=="JPG" || $ext=="JPEG" || $ext=="PNG" || $ext=="GIF" || $ext=="WEBP" || $ext=="TIFF" || $ext=="PSD" || $ext=="RAW" || $ext=="INDD" || $ext=="SVG") {
                    $attachment_type = 1;
                }
                else if ($ext=="MP4" || $ext=="3GP") {
                    $attachment_type = 2;
                }
                else if ($ext=="MP3") {
                    $attachment_type = 3;
                }
                else{
                    $attachment_type = 4;
                }
                //$attachment_full_name = $attachment_name.'.'.$ext;
                $upload_path = 'assets/images/message/';

                $success=$attachment->move($upload_path,$attachment_name);
                ##Save image to the message attachment table
                $msg_attachment = new MessageAttachment();
                $msg_attachment->message_master_id = $mm_id;
                $msg_attachment->admin_atachment = $attachment_name;
                $msg_attachment->attachment_type = $attachment_type;
                $msg_attachment->save();


            }
        }
        else{
            $new_msg = new MessageMaster();
            $new_msg->admin_id = $admin_id;
            $new_msg->admin_message = $admin_message;
            $new_msg->message_category = $category_id;
            $new_msg->group_id = $group_id;
            $new_msg->is_group_msg = 1;
            $new_msg->reply_to = $reply_to;
            $new_msg->save();
        }


//need to save notification for group user

    }

    public function newGroupMessageSeen($groupId){
	    return MessageMaster::where([
            ['group_id', $groupId]])
            ->whereNull('admin_message')
            ->update(['is_seen'=> 1]);
    }

    public function newMessageSeen($appUserId){
	    $message = MessageMaster::where('id', $appUserId)->get();

        return MessageMaster::where([
            ['app_user_id', $appUserId],
            ['is_group_msg', 0]])
            ->whereNull('admin_message')
            ->update(['is_seen'=> 1]);
    }




    public function loadGroupMessage(){
        $group_id 	            = $_POST['group_id'];
        $category_id 	        = $_POST['category_id'];
        $page_no 				= $_POST['page_no'];
        $limit 					= $_POST['limit'];
        $message_load_type		= $_POST['message_load_type'];
        $last_appuser_message_id= $_POST['last_appuser_message_id'];
        $start                  = ($page_no*$limit)-$limit;
        $end                    = $limit;
        $message                = array();


        if($message_load_type ==1 || $message_load_type ==3){
            $message = DB::table('message_masters as mm')
                ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
                ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
                ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
                ->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                ->where('mm.group_id',$group_id)
                ->where('mm.status','!=',0)
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.name as app_user_name' , 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
                ->groupBy('id')
                ->orderBy('mm.message_date_time', 'desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }
        else if($message_load_type==2){
            $message = DB::table('message_masters as mm')
                ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
                ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
                ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
                ->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                ->where('mm.group_id',$group_id)
                ->where(function ($query) {
                    $query->whereNotNull('mm.admin_message')
                        ->orWhere('mm.is_attachment', '>', 0);
                })
                ->where('mm.status','!=',0)
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id','apu.name as app_user_name' , 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
                ->groupBy('id')
                ->orderBy('mm.message_date_time', 'desc')
                ->limit(1)
                ->get();
        }
        else if($message_load_type==4){
            $message = DB::table('message_masters as mm')
                ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
                ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
                ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
                ->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                ->where('mm.group_id',$group_id)
                ->where(function ($query) {
                    $query->whereNotNull('mm.app_user_message')
                        ->orWhere('mm.is_attachment_app_user', '>', 0);
                })
                ->where('mm.status','!=',0)
                ->where('mm.id','>',$last_appuser_message_id)
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.name as app_user_name' ,'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
                ->groupBy('id')
                ->orderBy('mm.message_date_time', 'desc')
                ->get();
        }

        return json_encode(array(
            "message"=>$message
        ));

    }



    public function loadCategoryMessage(){
        //$category_id 	        = $_POST['category_id'];
        $category_id 	        = $_POST['category_id'];
        $page_no 				= $_POST['page_no'];
        $limit 					= $_POST['limit'];
        $message_load_type		= $_POST['message_load_type'];
        $last_appuser_message_id= $_POST['last_appuser_message_id'];
        $start                  = ($page_no*$limit)-$limit;
        $end                    = $limit;
        $message                = array();

        //return $category_id;


        $message = DB::table('message_masters as mm')
            ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
            ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
            ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
            ->leftJoin('user_groups as ug', 'ug.id','=','mm.group_id')
            ->where('mm.message_category',$category_id)
            ->where('mm.status','!=',0)
            ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.app_user_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.name as app_user_name' , 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
                DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name', 'ug.group_name')
            ->groupBy('id')
            ->orderBy('mm.message_date_time', 'desc')
            ->offset($start)
            ->limit($end)
            ->get();

        return json_encode(array(
            "message"=>$message
        ));

    }

    public function newMessageLoad(){
		$newMessage = array();
        $groupMessage = DB::table('message_masters as mm')
            ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->leftJoin('user_groups as ug', 'mm.group_id', '=', 'ug.id')
            ->where('mm.is_seen',0)
            ->where('mm.is_group_msg',1)
            ->whereNull('admin_message')
            ->select('mm.id as id', 'mm.app_user_id as app_user_id', 'mm.message_category as category_id', 'mm.group_id as group_id', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message','mm.created_at as msg_date', 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name', 'ug.group_name as group_name','apu.name as app_user_name')
            ->groupBy('mm.group_id', 'mm.message_category')
            ->orderBy('mm.created_at', 'desc')
            ->get();

        $individualMessage = DB::table('message_masters as mm')
            ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->where('mm.is_seen',0)
            ->where('mm.is_group_msg',0)
            ->whereNull('admin_message')
            ->select('mm.id as id', 'mm.app_user_id as app_user_id','mm.message_category as category_id', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message','mm.created_at as msg_date', 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name','apu.name as app_user_name')
            ->groupBy('mm.app_user_id')
            ->orderBy('mm.created_at', 'desc')
            ->get();
        foreach ($individualMessage as $value){
            $newMessage[strtotime($value->msg_date)]=$value;
        }
        foreach ($groupMessage as $value){
            $newMessage[strtotime($value->msg_date)]=$value;
        }
		if(!empty($newMessage)){
			usort($newMessage, function($a, $b)
			{
				if ($a == $b)
					return (0);
				return (($a < $b) ? -1 : 1);
			});
		}

        //$message = (object) array_merge((array) $groupMessage, (array) $individualMessage);

        return json_encode($newMessage);

    }



}
