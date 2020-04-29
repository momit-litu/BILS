<?php

namespace App\Http\Controllers;

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
            ->orderBy('n.date_time', 'desc')
            ->get();
        return json_encode($Notifications);
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
