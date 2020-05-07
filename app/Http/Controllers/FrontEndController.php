<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\MessageAttachment;
use App\Notice;
use Illuminate\Http\Request;
use App\MessageMaster;
use App\MessageCategory;
use App\Notification;
use DB;


class FrontEndController extends Controller
{

	public function __construct(Request $request)
    {
        $this->page_title = $request->route()->getName();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    public function authLogout($email) {
		//echo $email;die;
        if (\Auth::guard('appUser')->check()) {
            $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
           // print_r($user_info); die();
            if (!empty($user_info) && ($email==$user_info->email)) {
				\App\AppUser::LogInStatusUpdate(0);
                \Auth::guard('appUser')->logout();
                \Session::flush();
                return \Redirect::to('app/auth/login');
            } else {
                return \Redirect::to('app/auth/login');
            }
        } else {
            return \Redirect::to('app/auth/login')->with('errormessage',"Error logout");
        }
    }

	public function index()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Dashbord";
        return view('frontend.index', $data);
    }

	public function dashboard()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Dashboard";
        return view('frontend.dashboard', $data);
    }

	public function profileView()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Profile";
        return view('frontend.profile', $data);
    }

    public function updateProfile(Request $r){

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();


        if($r->hasFile('profile_image_upload')){
            if($user_info['user_profile_image']!=null || $user_info['user_profile_image']!=''){

                //file delete code will be here
            }
            $attachment = $r->file('profile_image_upload');

            //$attachment = $r->profile_image_upload;
            $attachment_name = rand().time().$attachment->getClientOriginalName();
            //return $attachment_name;

            $upload_path = 'assets/images/user/app_user';

            $success=$attachment->move($upload_path,$attachment_name);

        }
        else $attachment_name = $user_info['user_profile_image'];

        $column_value = [
            'name' => $r->name,
            'email' => $r->email,
            'contact_no' => $r->phone,
            'nid_no' => $r->nid,
            'address' => $r->address,
            'user_profile_image' => $attachment_name,
        ];

        $update = AppUser::where('id',$user_info['id'])->update($column_value);
        //$response = SurveyMaster::where('id','=',$request->survey_id)->update($column_value);
        return $update;


    }

    public function updatePassword (Request $r){
        //$password = bcrypt($r->old_password);

        //return $password;
        //$2y$10$qj1.MpDYAc6HUW4Wsut7GuCfHxk6WuZeyPcNOBUx85RgCNGnWxSX6
        //$2y$10$8MyHkYCo7xSK1KhKZ6h7X.fPokXUXi4mQVsrLjISHEmRB94zfT8ci

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();


        $v = \Validator::make($r->all(), [
            'old_password' => 'required',
        ]);
        //dd($v);
        if ($v->fails()) {
            return 1;
        }

        //$remember_me = $request->has('remember_me') ? true : false;
        $credentials = [
            'email' => $user_info['email'],
            'password'=>$r->input('old_password'),
            'status'=> "1"
        ];

        if (\Auth::guard('appUser')->attempt($credentials)) {
            //return 'good';
            if($r->new_password != $r->retype_new_password){
                return 1;
            }
            $columnValue=array(
                'password' => bcrypt($r->input('new_password')),
            );
            $update = AppUser::where('id',$user_info['id'])->update($columnValue);
            return 0;
        }
        else return 2;
	}

//$2y$10$8MyHkYCo7xSK1KhKZ6h7X.fPokXUXi4mQVsrLjISHEmRB94zfT8ci
//$2y$10$B.vLI3JouOxI.shQyQoVIOXbnTAU/pMpNWhCwx6MXHSeOxmxe0xFa


	public function messageList()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "";
        return view('frontend.message', $data);
    }

    public function profileInfo(){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        return(json_encode($user_info));
    }

    public  function messageListNotification(){
        $individualMessage = DB::table('message_masters as mm')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->leftJoin('app_user_group_members as apgm', 'mm.group_id','=','apgm.group_id')
            //->where('mm.is_seen',0)
            ->where(function ($query) {
                $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

                $query->where('mm.app_user_id', $user_info['id'])
                    ->orWhere(function ($query) {
                        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
                        $query->where('apgm.app_user_id', $user_info['id'])
                            ->Where('apgm.status','=', 1);
                    });
            })
            ->whereNotNull('admin_message')
            ->select('mm.id as id', 'mm.app_user_id as app_user_id','mm.is_seen','mm.message_category as category_id', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message','mm.created_at as msg_date', 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
            ->groupBy('mm.id')
            ->orderBy('mm.is_seen', 'asc')
            ->offset(1)
            ->limit(10)
            ->get();
        return json_encode($individualMessage);
    }

    public  function messageView($id){
        //return $id;
        $messageSeen = MessageMaster::where('id',$id)->get();
        if($messageSeen[0]['is_group_msg']==0){
            MessageMaster::where([['app_user_id',$messageSeen[0]['app_user_id']],['is_group_msg',0]])
                ->update(['is_seen'=>1]);
        }else{
            MessageMaster::where([['app_user_id',$messageSeen[0]['app_user_id']],['group_id',$messageSeen[0]['group_id']]])
                ->update(['is_seen'=>1]);
        }
        return 1;
    }

    public function newNotification(){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $Notifications = DB::table('notifications as n')
            //->where('n.status',0)
            ->where('n.to_id',$user_info['id'])
            ->select('n.id as id', 'n.notification_title as title', 'n.message as details','n.status', 'n.created_at as msg_date','n.module_id')
            ->groupBy('n.id')
            ->orderBy('n.status', 'asc')
            ->offset(1)
            ->limit(10)
            ->get();
        return json_encode($Notifications);
    }

    public function allNotification($page){
        $page_no 				= $page;
        $limit 					= 20;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $Notifications = DB::table('notifications as n')
            ->where('n.to_id',$user_info['id'])
            ->select('n.id as id', 'n.notification_title as title', 'n.status','n.message as details', 'n.date_time as msg_date', 'n.view_url as url')
            ->groupBy('n.id')
            ->orderBy('n.date_time', 'asc')
            ->offset($start)
            ->limit($end)
            ->get();
        return json_encode($Notifications);
    }

    public  function notificationView($id){
	    Notification::where('id',$id)->update(['status'=>1]);
	    $notification =  Notification::where('id',$id)->get();
	    return json_encode($notification);
    }

    public function userNotice( $page){
        $page_no 				= $page;
        $limit 					= 5;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;
        $date = date('Y-m-d');
        //return $date;
        $notice = DB::table('notices as n')
            /*->where('n.expire_date','>=',$date)*/
            ->select('n.id','n.title', 'n.details','n.created_at')
            ->groupBy('n.id')
            ->orderBy('n.created_at')
            ->offset($start)
            ->limit($end)
            ->get();

        return json_encode($notice);

    }

    public function userNoticeDetails($id){
        $notice = DB::table('notices as n')
            ->where('n.id',$id)
            ->select('n.id','n.title', 'n.details','n.notice_date','n.attachment','n.created_at')
            ->get();
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        Notification::where([['to_id',$user_info['id']],['module_id',37],['module_reference_id',$notice[0]->id]])->update(['status'=>1]);

        return json_encode($notice);
    }

    public function publications( $page){
        $page_no 				= $page;
        $limit 					= 5;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;
        //return 1;
        $date = date('Y-m-d');
        //return $date;
        $publication = DB::table('publications as p')
            ->where('p.status',1)
            ->select('p.id','p.publication_title as title', 'p.details','p.created_at', 'p.publication_type as type')
            ->groupBy('p.id')
            ->orderBy('p.created_at','desc')
            ->offset($start)
            ->limit($end)
            ->get();


        return json_encode($publication);
    }

    public function publicationsDtails($id){
        $publication = DB::table('publications as p')
            ->where('p.id',$id)
            ->select('p.id','p.publication_title as title', 'p.details','p.publication_type','p.authors','p.attachment','p.created_at', 'p.publication_type as type')
            ->get();

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        Notification::where([['to_id',$user_info['id']],['module_id',38],['module_reference_id',$publication[0]->id]])->update(['status'=>1]);


        return json_encode($publication);
    }

    public function userMessage(Request $r){
	    //return '1';

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $app_user_id_load_msg 	= $user_info['id'];
        $page_no 				= $_POST['page_no'];
        $limit 					= $_POST['limit'];
        $message_load_type		= $_POST['message_load_type'];
        $last_admin_message_id	= $_POST['last_admin_message_id'];
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;


        if($message_load_type ==1 || $message_load_type ==3){
            $message = DB::table('message_masters as mm')
                ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
                ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
                ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
                ->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                ->where('mm.app_user_id',$app_user_id_load_msg)
                ->where('mm.status','!=',0)
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.admin_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
                ->groupBy('id')
                ->orderBy('mm.message_date_time', 'desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }else if($message_load_type==2){
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
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.admin_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
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
					$query->whereNotNull('mm.admin_message')
					->orWhere('mm.is_attachment', '>', 0);
				})
				->where('mm.status','!=',0)
				->where('mm.id','>',$last_admin_message_id)
				->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.admin_message AS reply_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
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

    public function deleteMessage($id){
        MessageMaster::where('id',$id)->update(['status'=>0]);
        return 1;
    }


    public function getMessageCategory(){
        $data = MessageCategory::select('id', 'category_name')->get();
        return json_encode($data);
    }

    public function sendMessage(Request $r){
		//dd($r->all());
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        if($r->message_category==''){
            $msg_cat = $r->category_id;
        }
        else if($r->message_category){
            $msg_cat = $r->message_category;
        }
        else{
            $msg_cat = null;
        }
        if(isset($r->reply_msg_id)){
            $reply_to = $r->reply_msg_id;
        }else{
            $reply_to = null;
        }
        $app_user_id = $user_info['id'];
        $app_user_message = $r->message_input;
        $message_category = $msg_cat;
        $admin_id = null;
        ## Image
        $attachment = $r->file('attachment');

		if(isset($r->edit_msg_id) && $r->edit_msg_id>0){
			MessageMaster::where('id',$r->edit_msg_id)->update(['app_user_message'=>$app_user_message]);
			if($r->hasFile('attachment')){
				foreach ($attachment as $attachment) {
					$attachment_name = rand().time().$attachment->getClientOriginalName();
					$ext = strtoupper($attachment->getClientOriginalExtension());
					//echo $ext;
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

					if($success) MessageMaster::where('id',$r->edit_msg_id)->update(['is_attachment_app_user'=>1]);
					##Save image to the message attachment table
					$msg_attachment = new MessageAttachment();
					$msg_attachment->message_master_id = $r->edit_msg_id;
					$msg_attachment->app_user_attachment = $attachment_name;
					$msg_attachment->attachment_type = $attachment_type;
					$msg_attachment->save();
				}
			}
			return 1;
		}
		else{
			$new_msg = new MessageMaster();
			$new_msg->admin_id = $admin_id;
			$new_msg->app_user_message = $app_user_message;
			$new_msg->message_category = $message_category;
			$new_msg->app_user_id = $app_user_id;
			$new_msg->reply_to = $reply_to;

			$new_msg->save();
			$mm_id = $new_msg->id;

			if($r->hasFile('attachment')){
				foreach ($attachment as $attachment) {
					$attachment_name = rand().time().$attachment->getClientOriginalName();
					$ext = strtoupper($attachment->getClientOriginalExtension());
					//echo $ext;
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
					if($success) MessageMaster::where('id',$mm_id)->update(['is_attachment_app_user'=>1]);
					##Save image to the message attachment table
					$msg_attachment = new MessageAttachment();
					$msg_attachment->message_master_id = $mm_id;
					$msg_attachment->app_user_attachment = $attachment_name;
					$msg_attachment->attachment_type = $attachment_type;
					$msg_attachment->save();


				}
			}
			return $mm_id;
        }
    }

	public function noticeList()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Notice";

        return view('frontend.notice', $data);
    }


	public function noticeDetail()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Notice";
        return view('frontend.detail-notice', $data);
    }

	public function publicationList()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Publication";
        return view('frontend.publication', $data);
    }

	public function publicationDetail()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Publication";
        return view('frontend.detail-publication', $data);
    }

	public function notificationList()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Notification";
        return view('frontend.notification', $data);
    }

	public function courseList()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Course";
        return view('frontend.course', $data);
    }

	public function surveyList()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Survey";
        return view('frontend.survey', $data);
    }

    public function badgeCount(){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();


        $count = DB::table('notifications as n')
            ->leftJoin('menus as m', 'm.id', '=','n.module_id')
            ->select('n.module_id',
                DB::raw('COUNT(n.id) as number'))
            ->where('n.to_id','=',$user_info['id'])
            ->where('n.status','=',0)
            ->groupBy('n.module_id')
            ->orderBy('n.module_id')
            ->get();
        return json_encode($count);
    }




}
