<?php

namespace App\Http\Controllers;

use App\AppUserGroupMember;
use App\Notification;
use App\UserGroup;
use App\UserGroupMember;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\AppUser;
use App\System;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Hizbul\OnnorokomSms\Facades\OnnoRokomSMS;
use SoapClient;
//use App\Http\controller\sms;

use DB;

class AppAuthController extends Controller
{
    //$sms = new Sms();
	protected $redirectTo = '/app/dashboard';
    /**
     * Class constructor.
     * get current route name for page title.
     *
     */
    public function __construct(Request $request){
		$this->middleware('guest')->except('logout');
		$this->middleware('guest:appUser')->except('logout');

        $this->page_title = $request->route()->getName();
        $description = \Request::route()->getAction();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }


    /**
     * Show admin login page for admin
     * checked Auth user, if failed get user data according to email.
     * checked user type, if "admin" redirect to dashboard
     * or redirect to login.
     *
     * @return HTML view Response.
     */
    public function authLogin()
    {
        if (Auth::guard('appUser')->check()) {
            \App\AppUser::LogInStatusUpdate(1);
            return redirect('dashboard');

        } else {
            $data['page_title'] = $this->page_title;
            $session_email=\Session::get('email');
            if (!empty($session_email)) {
                $user_info=\DB::table('app_users')
                    ->where('email', $session_email)
                    ->select('email','name','user_profile_image')
                    ->first();
                $data['user_info']=$user_info;
            }
			//dd($data);
            return view('frontend.auth.login',$data);
        }
    }

    /**
     * Check Admin Authentication
     * checked validation, if failed redirect with error message
     * checked auth $credentials, if failed redirect with error message
     * checked user type, if "admin" change login status.
     *
     * @param  Request $request
     * @return Response.
     */
    public function authPostLogin(Request $request)
    {
        //return 1;
		 if (Auth::guard('appUser')->check()) {
            \App\AppUser::LogInStatusUpdate(1);
            return redirect('dashboard');

        }
        $validator = \Validator::make($request->all(), [
            'contact_no' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userId = AppUser::where([['contact_no',$request->input('contact_no')],['status',3]])->get('id')->first();
        if($userId!=null){

            $verification_no = rand(100000,999999);

            $message = "Your BILS Account Verification Code is ".$verification_no;
            $contact = $request->input('contact_no');

            app('App\Http\Controllers\sms')->sendSms($message,$contact);

            AppUser::where('id',$userId['id'])->update(['verification_no'=>$verification_no]);
            $return_data = array(
                'id'=>$userId['id'],
                'varificaiton_token'=>'',
                'type' =>1,
                'contact_number'=>$request->input('contact_no')
            );
            return view("frontend/auth/register_verify", compact("return_data"));
        }
        $remember_me = $request->has('remember_me') ? true : false;
        $credentials = [
            'contact_no' => $request->input('contact_no'),
            'password'=>$request->input('password'),
            'status'=> "1"
        ];

        if (\Auth::guard('appUser')->attempt($credentials)) {

            \Session::put('email', Auth::guard('appUser')->user()->email);
            \Session::put('contact_no', Auth::guard('appUser')->user()->contact_no);
            \Session::put('last_login', Auth::guard('appUser')->user()->last_login);
			$status_upadated = \App\AppUser::LogInStatusUpdate(1);
			return redirect('app/dashboard');
        } else {
            return redirect('app/auth/login')
                ->with('errormessage', __('auth.Incorrect_combinations') );
        }
    }

    /**
     * Admin logout
     * check auth login, if failed redirect with error message
     * get user data according to email
     * checked name slug, if found change login status and logout user.
     *
     * @param string $name_slug
     * @return Response.
     */
    public function authLogout($email)
    {
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
            return \Redirect::to('app/auth/login')->with('errormessage',__('auth.Error_logout'));
        }
    }


    public function authRegistration()
    {
        if (\Auth::guard('appUser')->check()) {
            \App\AppUser::LogInStatusUpdate(1);
           // return redirect('dashboard');

        } else {
            $data['page_title'] = $this->page_title;
			//dd($data);
           // return view('frontend.auth.register',$data);
			return view('frontend.auth.register',$data);
        }
    }


    /**
     * User Registration
     * checked validation, if failed redirect with message
     * data store into app_users table.
     *
     * @param Request $request
     * @return Response
     */
    public function authPostRegistration(Request $request)
    {
        $now = date('Y-m-d H:i:s');
        $v = \Validator::make($request->all(), [
            'name' => 'required',
            'contact_no'     => 'required | regex:/(0)[0-9]/  | unique:app_users',
            'email' => 'email|unique:app_users',
            'password' => 'required',
            'repeat_password' => 'required|in_array:password',
        ]);
		//dd($v);
        if ($v->fails()) {
            $userId = AppUser::where([['contact_no',$request->input('contact_no')],['status',3]])->get('id')->first();
            if($userId!=null){
                $verification_no = rand(100000,999999);
                $message = "Your BILS Account Verification Code is ".$verification_no;
                $contact = $request->input('contact_no');

                app('App\Http\Controllers\sms')->sendSms($message,$contact);

                AppUser::where('id',$userId['id'])->update(['verification_no'=>$verification_no]);
                $return_data = array(
                    'id'=>$userId['id'],
                    'varificaiton_token'=>'',
                    'type' =>1,
                    'contact_number'=>$request->input('contact_no')
                );
                return view("frontend/auth/register_verify", compact("return_data"));
            }
            return redirect()->back()->withErrors($v)->withInput();
        }

        $verification_no = rand(100000,999999);

        $registrationData=array(
            'name' => ucwords($request->input('name')),
            'user_profile_image' => '',
            'login_status' => 0,
            'status' => '1',
            'email' => $request->input('email'),
            'contact_no'=> $request->input('contact_no'),
            'password' => bcrypt($request->input('password')),
            'verification_no' => $verification_no,
            'created_at' => $now,
            'updated_at' => $now,
        );
		//dd($registration);
        try {

            DB::beginTransaction();
            $registration = new AppUser();
            $registration -> name = ucwords($request->input('name'));
            $registration -> user_profile_image = '';
            $registration -> login_status = 0;
            $registration -> status = 3;
            $registration -> email = $request->input('email');
            $registration -> contact_no = $request->input('contact_no');
            $registration -> password = bcrypt($request->input('password'));
            $registration ->verification_no = $verification_no;
            $registration -> created_at = $now;
            $registration -> updated_at = $now;
            $registration ->save();

            //$registration = \DB::table('app_users')->insert($registration);
            if ($registration) {
                //echo json_encode($registration);
                $userGroup = UserGroup::where('type',2)->get();
                foreach ($userGroup as $group){
                    $userGroupMember = new AppUserGroupMember();
                    $userGroupMember->app_user_id = $registration['id'];
                    $userGroupMember->group_id = $group['id'];
                    $userGroupMember->status = 0;
                    $userGroupMember->save();
                    //echo 2;

                }
                $notification = new Notification();
                $notification->from_id = $registration['id'];
                $notification->to_user_type = 'Admin';
                $notification->from_user_type = 'App User';
                $notification->notification_title = 'New User Registration';
                $notification->message = 'New User Registration';
                $notification->notification_title = $registration['name'].'Register to BILS';
                $notification->save();

                DB::commit();

                $message = "Your BILS Account Verification Code is ".$verification_no;
                $contact = $request->input('contact_no');

                app('App\Http\Controllers\sms')->sendSms($message,$contact);


                $return_data = array(
                    'id'=>$registration['id'],
                    'varificaiton_token'=>'',
                    'type' =>0,
                    'contact_number'=>$request->input('contact_no')

                );
                return view("frontend/auth/register_verify", compact("return_data"));

                //return redirect('app/auth/register_verify')->with('message',$return_data);
            }
        } catch(\Exception $e) {
            DB::rollback();
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            return json_encode($message);
            return redirect('app/auth/register')->with('errormessage',__('auth.Registration_faild') );
        }
    }

    public function authRegistrationVerification(Request $request){
        $verify = AppUser::where([['id','=',$request->input('id')],['verification_no','=',$request->input('verification_code')]])->update(['status' => 1]);

        if($verify){
            return redirect('app/auth/login')->with('message',__('auth.successfully_registered'));
        }else{
            return redirect('app/auth/login')->with('message',__('auth.something_went_wrong'));
        }
    }

    public function sendVerificationCode($contact_no){
        $userId = AppUser::where([['contact_no',$contact_no],['status',3]])->get('id')->first();
        if($userId!=null){
            $verification_no = rand(100000,999999);
            $message = "Your BILS Account Verification Code is ".$verification_no;
            $contact = $contact_no;

            app('App\Http\Controllers\sms')->sendSms($message,$contact);

            AppUser::where('id',$userId['id'])->update(['verification_no'=>$verification_no]);
            $return_data = array(
                'id'=>$userId['id'],
                'varificaiton_token'=>'',
                'type' =>1,
                'contact_number'=>$contact_no
            );
            return view("frontend/auth/register_verify", compact("return_data"));
        }
    }

    /**
     * Send mail to user who forget his account password
     * check user name exist, if not found redirect to same page.
     *
     * @param  $request
     * @return Response.
     */

    public function forgetPasswordAuthPage()
    {
        if (\Auth::guard('appUser')->check()) {
            return redirect('app/auth/login')->with('errormessage', __('auth.something_went_wrong') );
        } else {
            $data['page_title'] = $this->page_title;
            return view('frontend.auth.forget-password',$data);
        }
    }

    public function authForgotPasswordConfirm(Request $request)
    {

        //onnorokom_sms(['message' => 'some text msg', 'mobile_number' => '01757808214']);

        $v = \Validator::make($request->all(), [
            'contact_no' => 'required',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }
        $contact_no = $request->input('contact_no');

        $user_email= \App\AppUser::where('contact_no','=',$contact_no)->first();

        //return $user_email;

        if (!isset($user_email->id)) {
            return redirect('app/auth/forget/password')->with('errormessage',  __('auth.email_does_not_match') );
        }

        //send sms here

        $verification_no = rand(100000,999999);
        $message = "Your BILS Account Verification Code is ".$verification_no;
        $contact = $contact_no;

        app('App\Http\Controllers\sms')->sendSms($message,$contact);


        AppUser::where('id',$user_email['id'])->update(['verification_no'=>$verification_no]);
        $return_data = array(
            'id'=>$user_email['id'],
            'varificaiton_token'=>'',
            'type' =>1,
            'contact_number'=>$contact_no
        );
        return view("frontend/auth/set_password", compact("return_data"));


        #UpdateRememberToken

        /*
        $token = \App\System::RandomStringNum(16);
        \App\User::where('id',$user_email->id)->update(['remember_token'=>$token]);

        $reset_url= url('app/auth/forget/password/'.$user_email->id.'/verify').'?token='.$token;
		//echo $reset_url;die;
        //return \Redirect::to($reset_url);

        \App\System::ForgotPasswordEmail($user_email->id, $reset_url);
        return redirect('app/auth/forget/password')->with('message', __('auth.Please_check_your_mail') );
        */
    }

    public function authForgotPasswordCode($contact_no){
        $userId = AppUser::where('contact_no',$contact_no)->get('id')->first();
        if($userId!=null){
            //return 1;

            $verification_no = rand(100000,999999);
            $message = "Your BILS Account Verification Code is ".$verification_no;
            $contact = $contact_no;

            app('App\Http\Controllers\sms')->sendSms($message,$contact);

            AppUser::where('id',$userId['id'])->update(['verification_no'=>$verification_no]);
            $return_data = array(
                'id'=>$userId['id'],
                'varificaiton_token'=>'',
                'type' =>1,
                'contact_number'=>$contact_no
            );
            return view("frontend/auth/set_password", compact("return_data"));
        }
    }

    /**
     * creating form for new password
     * update password according to user_id.
     *
     * @param int $app_users_id
     * @return HTML view Response.
     */
    public function authSystemForgotPasswordVerification($user_id)
    {
        $remember_token=isset($_GET['token'])?$_GET['token']:'';
        $user_info= \App\User::where('id','=',$user_id)->first();

        if(!empty($remember_token)&&isset($user_info->id) && !empty($user_info->remember_token) && ($user_info->remember_token==$remember_token)){

            $data['user_info']=$user_info;
            $data['page_title'] = $this->page_title;
            return \View::make('frontend.auth.set-new-password',$data);

        }else return redirect('app/auth/forget/password')->with('errormessage', __('auth.Sorry_invalid_token') );

    }


    /**
     * Set new password according to user
     * check validation, if failed redirect same page with error message
     * change user password and update user table.
     *
     * @param Request $request
     * @return Response.
     */
    public function authSystemNewPasswordPost(Request $request)
    {
        $verified = AppUser::where([['id','=',$request->input('id')],['verification_no','=',$request->input('verification_code')]])->first();

        if(!isset($verified->id)){
            $validator = array(
                'name' => "Token Did not matched"
            );
            return redirect()->back()->withErrors($validator)->withInput();
        }

        //return 1;
        $now = date('Y-m-d H:i:s');
        $validator = \Validator::make($request->all(), [
            'password' => 'required|min:4',
            'repeat_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        //return 2;

        $user_id =  $request->input('id');

        $update_password=array(
            'password' => bcrypt($request->input('password')),
            'remember_token' => null,
            'updated_at' => $now
        );
        try {

            $update_pass=AppUser::where('id', $user_id)->update($update_password);

            if($update_pass) {
                //return 3;

                return redirect('app/auth/login')->with('message',"Password updated successfully !");
            }
        } catch(\Exception $e) {
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            return redirect('app/auth/login')->with('errormessage', __('auth.Password_update_failed'));
        }

    }


    public function EmailVerificationPage($user_id)
    {
        $remember_token=isset($_GET['token'])?$_GET['token']:'';
        $user_info= \App\User::where('id','=',$user_id)->first();

        if(!empty($remember_token)&&isset($user_info->id) && !empty($user_info->remember_token) && ($user_info->remember_token==$remember_token)){

            $data['user_info']=$user_info;
            $data['page_title'] = $this->page_title;
            return \View::make('partner.partner-set-new-password',$data);

        }else return redirect('/')->with('errormessage', __('auth.Sorry_invalid_token') );

    }


    public function EmailUpdateNewPassword(Request $request,$user_id)
    {
        $now = date('Y-m-d H:i:s');
        $validator = \Validator::make($request->all(), [
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user_id =  \Request::input('user_id');

        $update_password=array(
            'password' => bcrypt($request->input('password')),
            'remember_token' => null,
            'updated_at' => $now
        );
        try {
            $update_pass=\App\User::where('id', $user_id)->update($update_password);

            if($update_pass) {
                return redirect('app/auth/login')->with('message', __('auth.Password_updated_successfully_') );
            }
        } catch(\Exception $e) {
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            return redirect('app/auth/login')->with('errormessage',  __('auth.Password_update_failed') );
        }
    }
}
