<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\AppUser;
use App\System;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AppAuthController extends Controller
{
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
           // return redirect('dashboard');

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
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
		
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $remember_me = $request->has('remember_me') ? true : false;
        $credentials = [
            'email' => $request->input('email'),
            'password'=>$request->input('password'),
            'status'=> "1"
        ];
		dd($credentials);
        if (\Auth::guard('appUser')->attempt($credentials)) {
		
            \Session::put('email', Auth::guard('appUser')->user()->email);
            \Session::put('last_login', Auth::guard('appUser')->user()->last_login);
            if (\Session::has('pre_login_url') ) {
                $url = \Session::get('pre_login_url');
                \Session::forget('pre_login_url');
                return redirect($url);
            }else {	
                \App\AppUser::LogInStatusUpdate(1);
                return redirect('dashboard');
            }

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
            'email' => 'required|email|unique:app_users',
            'password' => 'required',
            'repeat_password' => 'required|in_array:password',
        ]);
		//dd($v);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }

        $registration=array(
            'name' => ucwords($request->input('name')),
            'user_profile_image' => '',
            'login_status' => 0,
            'status' => '1',
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'created_at' => $now,
            'updated_at' => $now,
        );
		//dd($registration);
        try {
            $registration = \DB::table('app_users')->insert($registration);
            if ($registration) {
                return redirect('app/auth/login')->with('message',__('auth.successfully_registered'));
            }
        } catch(\Exception $e) {
            $message = "Message : ".$e->getMessage().", File : ".$e->getFile().", Line : ".$e->getLine();
            return redirect('app/auth/reghister')->with('errormessage',__('auth.Registration_faild') );
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
        $v = \Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($v->fails()) {
            return redirect()->back()->withErrors($v)->withInput();
        }
        $email = $request->input('email');
        $user_email= \App\User::where('email','=',$email)->first();
        if (!isset($user_email->id)) {
            return redirect('app/auth/forget/password')->with('errormessage',  __('auth.email_does_not_match') );
        }


        #UpdateRememberToken
        $token = \App\System::RandomStringNum(16);
        \App\User::where('id',$user_email->id)->update(['remember_token'=>$token]);

        $reset_url= url('app/auth/forget/password/'.$user_email->id.'/verify').'?token='.$token;
		echo $reset_url;die;
        //return \Redirect::to($reset_url);

        \App\System::ForgotPasswordEmail($user_email->id, $reset_url);
        return redirect('app/auth/forget/password')->with('message', __('auth.Please_check_your_mail') );
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
