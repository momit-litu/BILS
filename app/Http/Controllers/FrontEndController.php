<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
