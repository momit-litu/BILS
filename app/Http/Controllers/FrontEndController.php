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


	public function messageList()
    {
        $data['page_title'] = $this->page_title;
		$data['module_name']= "";
        return view('frontend.message', $data);
    }

    public  function messageListNotification(){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $individualMessage = DB::table('message_masters as mm')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->where('mm.is_seen',0)
            ->where('mm.app_user_id',$user_info['id'])
            ->whereNotNull('admin_message')
            ->select('mm.id as id', 'mm.app_user_id as app_user_id','mm.message_category as category_id', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message','mm.created_at as msg_date', 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
            ->groupBy('mm.id')
            ->orderBy('mm.created_at', 'desc')
            ->get();
        return json_encode($individualMessage);
    }

    public function newNotification(){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $Notifications = DB::table('notifications as n')
            ->where('n.status',0)
            ->where('n.to_id',$user_info['id'])
            ->select('n.id as id', 'n.notification_title as title', 'n.message as details', 'n.created_at as msg_date')
            ->groupBy('n.id')
            ->orderBy('n.created_at', 'desc')
            ->get();
        return json_encode($Notifications);
    }

    public function allNotification(){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $Notifications = DB::table('notifications as n')
            ->where('n.to_id',$user_info['id'])
            ->select('n.id as id', 'n.notification_title as title', 'n.message as details', 'n.date_time as msg_date', 'n.view_url as url')
            ->groupBy('n.id')
            ->orderBy('n.date_time', 'asc')
            ->get();
        return json_encode($Notifications);
    }

    public function usernotice(){
	    //return 1;
        $date = date('Y-m-d');
        //return $date;
        $notice = DB::table('notices as n')
            ->where('n.expire_date','>=',$date)
            ->select('n.id','n.title', 'n.details','n.created_at')
            ->groupBy('n.id')
            ->orderBy('n.created_at')
            ->get();

        return json_encode($notice);

    }

    public function publications(){
        //return 1;
        $date = date('Y-m-d');
        //return $date;
        $notice = DB::table('publications as p')
            ->where('p.status',1)
            ->select('p.id','p.publication_title as title', 'p.details','p.created_at', 'p.publication_type as type')
            ->groupBy('p.id')
            ->orderBy('p.created_at','desc')
            ->get();

        return json_encode($notice);
    }

    public function userMessage(){
	    //return '1';

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $message = DB::table('message_masters as mm')
            ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
            ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
            ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->where('mm.app_user_id',$user_info['id'])
            ->select('mm.id as id', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message','mm.created_at as msg_date',
                DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
            ->groupBy('id')
            ->orderBy('mm.message_date_time', 'desc')
            ->limit(10)
            ->get();
        //dd($message);
        $app_user_name = AppUser::select('name', 'id', 'user_profile_image')
            ->where('id', $user_info['id'])
            ->first();


        return json_encode(array(
            "message"=>$message,
            "app_user_name"=>$app_user_name,
            //"msg_date"=>$msg_date,
        ));    }

    public function sendMessage(Request $r){
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

        if($r->hasFile('attachment')){
            $new_msg = new MessageMaster();
            $new_msg->admin_id = $admin_id;
            $new_msg->app_user_message = $app_user_message;
            $new_msg->message_category = $message_category;
            $new_msg->app_user_id = $app_user_id;
            $new_msg->reply_to = $reply_to;
            $new_msg->is_attachment = 1;
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
                $msg_attachment->app_user_atachment = $attachment_name;
                $msg_attachment->attachment_type = $attachment_type;
                $msg_attachment->save();


            }
        }
        else{
            if(isset($r->edit_msg_id) && $r->edit_msg_id>0){
                MessageMaster::where('id',$r->edit_msg_id)->update(['app_user_message'=>$app_user_message]);
                return 0;
            }

            $new_msg = new MessageMaster();
            $new_msg->admin_id = $admin_id;
            $new_msg->app_user_message = $app_user_message;
            $new_msg->app_user_id = $app_user_id;
            $new_msg->reply_to = $reply_to;
            $new_msg->message_category = $message_category;
            $new_msg->save();
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


}
