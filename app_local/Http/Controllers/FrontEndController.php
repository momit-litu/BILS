<?php

namespace App\Http\Controllers;

use App\AppUser;
use App\CourseMaster;
use App\CoursePerticipant;
use App\MessageAttachment;
use App\Notice;
use App\SurveyMaster;
use App\SurveyParticipatentAnswer;
use App\SurveyParticipatentAnswerOption;
use App\SurveyQuestion;
use App\UserGroup;
use Illuminate\Http\Request;
use App\MessageMaster;
use App\MessageCategory;
use App\Notification;
use App\SurveyParticipatent;
use App\SurveyQuestionAnswerOption;
use DB;
use mysql_xdevapi\Session;


class FrontEndController extends Controller
{

	public function __construct(Request $request)
    {
        $this->page_title = $request->route()->getName();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
        $this->language =  \Session::get('locale');

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
    public function contentLoad()
    {
        $data['page_title'] = $this->page_title;
        $data['module_name']= "Dashbord";
        return view('frontend.content_load', $data);
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

	public function messageList(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "";
        return view('frontend.message', $data);
    }

    public function profileInfo(){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        return(json_encode($user_info));
    }

    public  function messageListNotification(){
        $category = $this->language==='en'? 'mc.category_name as category_name': 'mc.category_name_bn as category_name';

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
            ->select('mm.id as id', 'mm.app_user_id as app_user_id','mm.is_seen','mm.message_category as category_id', 'mm.group_id as group_id','mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'), 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', $category)
            ->groupBy('mm.id')
            ->orderBy('mm.created_at', 'asc')
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
	    //return Session::get('locale');
        $category = $this->language==='en'? 'mc.category_name as category_name': 'mc.category_name_bn as category_name';
        $group = $this->language==='en'? 'ug.group_name as group_name': 'ug.group_name_bn as group_name';


        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
		$Notifications = DB::table('notifications as n')
            /*->where('n.status',0)*/
            ->where('n.to_id',$user_info['id'])
            ->select('n.id as id', 'n.notification_title as title', 'n.message as details','n.status', DB::Raw('from_unixtime(UNIX_TIMESTAMP(n.created_at)) as msg_date'),'n.module_id')
            ->groupBy('n.id')
            ->orderBy('n.id', 'desc')
            /*->offset(1)*/ // dont know why u used this chaki?
            ->limit(10)
            ->get();

        $individualMessage = DB::table('message_masters as mm')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->leftJoin('user_groups as ug', 'mm.group_id','=','ug.id')
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
            ->select('mm.id as id', $group,'mm.app_user_id as app_user_id','mm.is_seen','mm.message_category as category_id', 'mm.group_id as group_id','mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'), 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', $category)
            ->groupBy('mm.id')
            ->orderBy('mm.id', 'desc')
            ->offset(0)
            ->limit(10)
            ->get();
        return json_encode(array(
            "individualMessage"=>$individualMessage,
            "Notifications"=>$Notifications
        ));
    }

    public function allNotification($page){
        $page_no 				= $page;
        $limit 					= 10;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $Notifications = DB::table('notifications as n')
            ->where('n.to_id',$user_info['id'])
            ->select('n.id as id', 'n.notification_title as title', 'n.status','n.message as details', DB::Raw('from_unixtime(UNIX_TIMESTAMP(n.created_at)) as msg_date'),'n.module_id', 'n.view_url as url')
            ->groupBy('n.id')
            ->orderBy('n.date_time', 'desc')
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

    public function userNotice( $page, $txt){
        $page_no 				= $page;
        $limit 					= 5;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;
        $date = date('Y-m-d');
        //return $date;
        if($txt!='' && $txt!= null && $txt!='a') {
            $notice = DB::table('notices as n')
                /*->where('n.expire_date','>=',$date)*/
                ->where('n.title',"like","%".$txt."%")
                ->orWhere("n.details","like","%".$txt."%")
                ->select('n.id', 'n.title', 'n.details', DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'))
                ->groupBy('n.id')
                ->orderBy('n.created_at', 'desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }else {
            $notice = DB::table('notices as n')
                /*->where('n.expire_date','>=',$date)*/
                ->select('n.id', 'n.title', 'n.details', DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'))
                ->groupBy('n.id')
                ->orderBy('n.created_at', 'desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }

        return json_encode($notice);

    }

    public function userNoticeDetails($id){
        $notice = DB::table('notices as n')
            ->where('n.id',$id)
            ->select('n.id','n.title', 'n.details',DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as notice_date'),DB::Raw('IFNULL( n.attachment , "" ) as attachment'),'n.created_at')
            ->get();
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        Notification::where([['to_id',$user_info['id']],['module_id',37],['module_reference_id',$notice[0]->id]])->update(['status'=>1]);

        return json_encode($notice);
    }

    public function courses( $page, $txt){

        $page_no 				= $page;
        $limit 					= 5;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;
        //return 1;
        $date = date('Y-m-d');
        //return $date;
        //return $txt;

        if($txt!='' && $txt!= null && $txt!='a'){
            $course = DB::table('course_masters as p')
                ->where("p.course_title","like","%".$txt."%")
                ->orWhere("p.details","like","%".$txt."%")
                ->select('p.id','p.course_title as title', 'p.details',DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'), 'p.course_type as type')
                ->groupBy('p.id')
                ->orderBy('p.created_at','desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }
        else{
            $course = DB::table('course_masters as p')
                ->select('p.id','p.course_title as title', 'p.details',DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'), 'p.course_type as type')
                ->groupBy('p.id')
                ->orderBy('p.created_at','desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }

        return json_encode($course);
    }

   
    public function courseDtails($id){
        $category = $this->language==='en'? 'cc.category_name as category_name': 'cc.category_name_bn as category_name';
		$user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
		
        $publication = DB::table('course_masters as p')
            ->leftJoin('teachers as t','p.course_teacher','=','t.id')
            ->leftJoin('course_categories as cc','p.course_type','=','cc.id')
			->leftJoin('course_perticipants as cp','p.id','=','cp.course_id')
            ->where('p.id','=',$id)
            ->where('cp.perticipant_id','=',$user_info['id'])
            ->select('p.id','p.course_title as title', 'is_interested', 'p.payment_fee', 'p.details','p.perticipants_limit','p.course_type','t.name','p.attachment',$category,
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.created_at)) as created_at'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.appx_start_time)) as appx_start_time'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.appx_end_time)) as appx_end_time'),
                DB::raw('(CASE WHEN p.course_status = 1 THEN "Initiate" WHEN p.course_status = 2 THEN "Approved" WHEN p.course_status = 3 THEN "Rejected"  ELSE "Started" END) AS status'))
            ->get();

        Notification::where([['to_id',$user_info['id']],['module_id',37],['module_reference_id',$id]])->update(['status'=>1]);


        return json_encode($publication);
    }


    public function courseInterest($id){
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $interested = CoursePerticipant::where([['perticipant_id',$user_info['id']],['course_id',$id]])->get('id');
        try {
            if(!isset($interested[0])){
                $course = new CoursePerticipant();
                $course->perticipant_id = $user_info['id'];
                $course->course_id = $id;
                $course->is_interested = 1;
                $course->status = 1;
                $course->save();
                //$courseId= $course->save();
            }else{
                $columnValue=array(
                    'is_interested' => 1,
                    'status'=>1,
                );
                CoursePerticipant::where([['perticipant_id',$user_info['id']],['course_id',$id]])->update($columnValue);
            }
            $course_details = CourseMaster::where('id', $id)->get('course_title');
            $column_value1 = [
                'from_id'=>$user_info['id'],
                'from_user_type'=>'App User',
                'to_user_type'=>'Admin',
                'notification_title'=>$user_info['name'].' interested for a course',
                'message'=>$user_info['name'].' interested for the course entitle: '.$course_details[0]['course_title'],
                'view_url'=>'course/'.$id,
                'module_id'=>7,
                'module_reference_id'=>$id
            ];
            Notification::create($column_value1);
            $return['result'] = "1";
            return json_encode($return);
        }catch (\Exception $e){
            return 0;

        }
    }


    public function userCourse(){

        $category = $this->language==='en'? 'cc.category_name as category_name': 'cc.category_name_bn as category_name';

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $course = DB::table('course_masters as p')
            ->leftJoin('teachers as t','p.course_teacher','=','t.id')
            ->leftJoin('course_categories as cc','p.course_type','=','cc.id')
            ->leftJoin('course_perticipants as cp','p.id','=','cp.course_id')
            ->where('cp.perticipant_id','=',$user_info['id'])
            ->whereIn('cp.is_interested',['1','2','4'])
            ->select('p.id','cp.id as cp_id','cp.perticipant_id','p.course_title as title','p.payment_fee', 'p.details','p.perticipants_limit','p.course_type','t.name','p.attachment',$category, 'cp.is_interested',
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.created_at)) as created_at'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.appx_start_time)) as appx_start_time'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.appx_end_time)) as appx_end_time'),
                DB::raw('(CASE WHEN p.course_status = 1 THEN "Initiate" WHEN p.course_status = 2 THEN "Approved" WHEN p.course_status = 3 THEN "Rejected"  ELSE "Started" END) AS status'),
                DB::raw('(CASE WHEN cp.is_interested = 1 THEN "Interested" WHEN cp.is_interested = 2 THEN "Registered" WHEN cp.is_interested = 4 THEN "Completed"  ELSE "Not interested" END) AS course_interested')
                )
            ->orderBy('cp.is_interested')
            ->get();

        return json_encode($course);
	}

    public function userCourseDescription($id){
        $category = $this->language==='en'? 'cc.category_name as category_name': 'cc.category_name_bn as category_name';

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $course = DB::table('course_masters as p')
            ->leftJoin('teachers as t','p.course_teacher','=','t.id')
            ->leftJoin('course_categories as cc','p.course_type','=','cc.id')
            ->leftJoin('course_perticipants as cp', function($leftJoin)
            {
                $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

                $leftJoin->on('p.id','=','cp.course_id')
                    ->where('cp.perticipant_id', '=', $user_info['id'] );
            })
            ->where('p.id','=',$id)
            ->select('p.id','p.course_status','cp.id as cp_id','cp.perticipant_id','cp.payment_status','p.course_title as title','p.payment_fee', 'p.details','p.perticipants_limit','p.course_type','t.name','p.attachment',$category, 'cp.is_interested',
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.created_at)) as created_at'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.appx_start_time)) as appx_start_time'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.appx_end_time)) as appx_end_time'),
                DB::raw('(CASE WHEN p.course_status = 1 THEN "Initiate" WHEN p.course_status = 2 THEN "Approved" WHEN p.course_status = 3 THEN "Rejected"  ELSE "Started" END) AS status'),
                DB::raw('(CASE WHEN cp.is_interested = 1 THEN "Interested" WHEN cp.is_interested = 2 THEN "Registered" WHEN cp.is_interested = 4 THEN "Completed"  ELSE "Not interested" END) AS course_interested')
                )
            ->orderBy('cp.is_interested')
            ->get();

        return json_encode($course);
    }

    public function userCourseRegistration ($id){
        //$user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        CoursePerticipant::where('id',$id)->update(['is_interested'=>2]);
        //Notification::where([['to_id',$user_info['id']],['module_id',6],['module_reference_id',$id]])->update(['status'=>1]);

        return 1;

    }

    public function userSurvey(){

        $category = $this->language==='en'? 'cc.category_name as category_name': 'cc.category_name_bn as category_name';

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $course = DB::table('survey_masters as p')
            ->leftJoin('survey_categories as cc','p.survey_category','=','cc.id')
            ->leftJoin('survey_participants as cp','p.id','=','cp.survey_id')
            ->where('cp.app_user_id','=',$user_info['id'])
            ->select('p.id','cp.id as cp_id','p.survey_name as title', 'p.details',$category, 'cp.survey_completed',
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.created_at)) as created_at'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.start_date)) as start_date'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.end_date)) as end_date'),
                DB::raw('(CASE WHEN p.status = 1 THEN "Initiate" WHEN p.status = 2 THEN "Published" WHEN p.status = 3 THEN "Closed"  ELSE "In Active" END) AS status')
                )
            ->orderBy('cp.survey_completed')
            ->get();

        return json_encode($course);
    }

    public function userSurveyDescription($id){
        $category = $this->language==='en'? 'cc.category_name as category_name': 'cc.category_name_bn as category_name';

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $course = DB::table('survey_masters as p')
            ->leftJoin('survey_categories as cc','p.survey_category','=','cc.id')
            ->leftJoin('survey_participants as cp','p.id','=','cp.survey_id')
            ->where('p.id','=',$id)
            ->select('p.id','cp.id as cp_id','p.survey_name as title', 'p.details',$category, 'cp.survey_completed',
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.created_at)) as created_at'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.start_date)) as start_date'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.end_date)) as end_date'),
                DB::raw('(CASE WHEN p.status = 1 THEN "Initiate" WHEN p.status = 2 THEN "Published" WHEN p.status = 3 THEN "Closed"  ELSE "In Active" END) AS status')
                )
            ->get();

        return json_encode($course);

        return json_encode($course);
    }

    public function surveyInterest($id){
	    //not fully done yet
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $interested = SurveyParticipatent::where([['app_user_id',$user_info['id']],['survey_id',$id]])->get('id');

        if(!isset($interested[0])){

            $servey = new SurveyParticipatent();
            $servey->app_user_id = $user_info['id'];
            $servey->survey_id = $id;
            $servey->survey_completed = 0;
            $servey->answer_date = date("Y-m-d");

            $servey->save();
            return $servey->save();
        }else{
            return $interested;
        }

        $columnValue=array(
            'is_interested' => 1,
            'status'=>1,
        );

        //$return =  CoursePerticipant::where([['perticipant_id',$user_info['id']],['course_id',$id]])->update($columnValue);

    }


    public function allSurvey( $page, $txt){

        $page_no 				= $page;
        $limit 					= 5;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;
        //return 1;
        $date = date('Y-m-d');
        //return $date;
        //return $txt;
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $category = $this->language==='en'? 'cs.category_name as category_name': 'cs.category_name_bn as category_name';


        if($txt!='' && $txt!= null && $txt!='a'){
            $survey = DB::table('survey_masters as p')
                ->leftJoin('survey_categories as cs','','=','cs.id')
                ->leftJoin('survey_participants as sp', function($leftJoin)
                {
                    $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
                    $leftJoin->on('sp.survey_id', '=', 'p.id')
                        ->where('sp.app_user_id','=',$user_info['id'])
                        ->where('sp.survey_completed','!=','1');
                })
                ->where('p.status','<','2')
                ->where("p.survey_name","like","%".$txt."%")
                ->orWhere("p.details","like","%".$txt."%")
                ->select('p.id','p.survey_name as title', 'p.details',DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'), $category)
                ->groupBy('p.id')
                ->orderBy('p.created_at','desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }
        else{
            $survey = DB::table('survey_masters as p')
                ->leftJoin('survey_categories as cs','p.survey_category','=','cs.id')
                ->leftJoin('survey_participants as sp', function($leftJoin)
                {
                    $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
                    $leftJoin->on('sp.survey_id', '=', 'p.id')
                        ->where('sp.app_user_id','=',$user_info['id']);
                })
                ->where('p.status','<','2')
                ->where('sp.survey_completed','=','0')
                ->orWhere('sp.survey_completed','=',null)
                ->select('p.id','p.survey_name as title','sp.id as spid', 'p.details',DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.created_at)) as created_at'), $category)
                ->groupBy('p.id')
                ->orderBy('p.created_at','desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }

        return json_encode($survey);
    }

    public function surveyDtails($id){
        $category = $this->language==='en'? 'cs.category_name as category_name': 'cs.category_name_bn as category_name';

        $survey = DB::table('survey_masters as p')
            ->leftJoin('survey_categories as cs','p.survey_category','=','cs.id')
            ->where('p.id','=',$id)
            ->select('p.id','p.survey_name as title', 'p.details',$category,
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.created_at)) as created_at'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.start_date)) as start_date'),
                DB::Raw('from_unixtime(UNIX_TIMESTAMP(p.end_date)) as end_date'),
                DB::raw('(CASE WHEN p.status = 0 THEN "Initiate" WHEN p.status = 1 THEN "Published" WHEN p.status = 2 THEN "Closed"  ELSE "In Active" END) AS status'))
            ->get();

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        Notification::where([['to_id',$user_info['id']],['module_id',6],['module_reference_id',$id]])->update(['status'=>1]);


        return json_encode($survey);
    }

    public function loadSurveyTitle($id){
        $question = SurveyMaster::where('id',$id)->get('survey_name');
        return json_encode($question);

    }

    public function loadSurveyQuestion($id){
	    //return $id;
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        //$user_id = $user_info['id'];
        $user_id = $user_info['id'];
        $surveyTitle = SurveyMaster::where('id',$id)->get('survey_name');

        $question = SurveyQuestion::where('survey_id',$id)->with('options')->paginate(1);
        $surveyParticipant = SurveyParticipatent::where([['survey_id',$id],['app_user_id',$user_id]])->get();


        $answer = SurveyParticipatentAnswer::where([['survey_question_id',$question[0]['id']],['survey_participan_id',$surveyParticipant[0]['id']]])->with('options')->get();
        //return json_encode($answer);
        $question['answer'] = $answer;
        $question['title'] = $surveyTitle[0]['survey_name'];

        return json_encode($question);

    }

    public function surveyAnswer(Request $r){

        if($r->answer==null) return 'Answer missing';
	    //return json_encode($r->answer[0]);
        //return json_encode($r->is_completed);

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $surveyParticipant = SurveyParticipatent::where([['app_user_id',$user_info['id']],['survey_id',$r->survey_id]])->get('id');
        //return json_encode($surveyParticipant);

        if(!isset($surveyParticipant[0])){
            $survey_participant = new SurveyParticipatent();
            $survey_participant->app_user_id = $user_info['id'];
            $survey_participant->survey_id = intval($r->survey_id);
            $survey_participant->save();
            $survey_participant_id = $survey_participant['id'];
        }else {
            $survey_participant_id = $surveyParticipant[0]['id'];
        }
        //return json_encode($survey_participant_id);

        $surveyAnswer = SurveyParticipatentAnswer::where([['survey_participan_id',$survey_participant_id],['survey_question_id',$r->question_no]])->get();
        if(isset($r->is_completed) && $r->is_completed==1){
             SurveyParticipatent::where([['app_user_id',$user_info['id']],['survey_id',$r->survey_id]])->update(['survey_completed'=>1]);
        }
        if(isset($surveyAnswer[0])){

            if($r->type==1 || $r->type==2) {
                $return = SurveyParticipatentAnswerOption::where('survey_participant_answer_id',$surveyAnswer[0]['id'])->update(['answer'=>$r->answer]);
                return 1;
            }else if($r->type==3) {
                $return = SurveyParticipatentAnswerOption::where('survey_participant_answer_id',$surveyAnswer[0]['id'])->update(['option_id'=>$r->answer]);
                return 1;
            } else if($r->type==4){
                SurveyParticipatentAnswerOption::where('survey_participant_answer_id',$surveyAnswer[0]['id'])->delete();
                foreach ($r->answer as $answer){
                    $p_answer_option = new SurveyParticipatentAnswerOption();
                    $p_answer_option->survey_participant_answer_id = $surveyAnswer[0]['id'];
                    $p_answer_option->option_id = intval($answer);
                    $p_answer_option->save();
                }
                return 1;
            }
            //return $surveyAnswer[0]['id'];

        }else{
            $p_answer = new SurveyParticipatentAnswer();
            $p_answer->survey_participan_id = $survey_participant_id;
            $p_answer->survey_question_id = $r->question_no;
            $p_answer->save();
            $p_answer_id = $p_answer->id;
            if($r->type==1 || $r->type==2){
                $p_answer_option = new SurveyParticipatentAnswerOption();
                $p_answer_option->survey_participant_answer_id = $p_answer_id;
                $p_answer_option->option_id = 0;
                $p_answer_option->answer = $r->answer;
                $p_answer_option->save();
            }else if($r->type==3){
                $p_answer_option = new SurveyParticipatentAnswerOption();
                $p_answer_option->survey_participant_answer_id = $p_answer_id;
                $p_answer_option->option_id = $r->answer;
                $p_answer_option->save();
            }else if($r->type==4){
                foreach ($r->answer as $answer){
                    $p_answer_option = new SurveyParticipatentAnswerOption();
                    $p_answer_option->survey_participant_answer_id = $p_answer_id;
                    $p_answer_option->option_id = intval($answer);
                    $p_answer_option->save();
                }
            }
            return 1;
        }

        /*
            $new_msg = new MessageMaster();
			$new_msg->admin_id = $admin_id;
			$new_msg->app_user_message = $app_user_message;
			$new_msg->message_category = $message_category;
			$new_msg->app_user_id = $app_user_id;
			$new_msg->reply_to = $reply_to;
            $new_msg->group_id = $group_id;


            $new_msg->save();
			$mm_id = $new_msg->id;
         */
    }

    public  function surveyParticipantResultView($survey_id){

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        $survey = SurveyMaster::find($survey_id);
        $data['survey']=$survey;
        $question =SurveyQuestion ::where('survey_id','=',$survey_id)->orderBy('serial')->get();
        //echo json_encode($question);
        foreach ($question as $i=>$values){
            $data['question'][$values['serial']]=$values;
            $data['question'][$values['serial']]['answer'] =SurveyQuestionAnswerOption ::where('survey_question_id','=',$values['id'])->get();
        }


        $answers = DB::table('survey_participants as sp')
            ->leftJoin('survey_participant_answers as spa','spa.survey_participan_id','=','sp.id')
            ->leftJoin('survey_participant_answer_options as spao','spao.survey_participant_answer_id','=','spa.id')
            ->select('spa.survey_question_id','spao.option_id','spao.answer')
            ->where('sp.survey_id', $survey_id)
            ->where('sp.app_user_id',$user_info['id'])
            ->get();
        //return json_encode($answers);

        $answers_list=[];
        foreach ($answers as $key=>$value){
            $answers_list[$value->survey_question_id]=$value;
            if($value->option_id!=0 && $value->option_id!=''){
                $answers_list['answer_choice'][]=$value->option_id;
            }
        }
        $data['answer']=$answers_list;
        return json_encode($data);

        //return $survey_data;
    }



    public function publications( $page, $txt){

        $page_no 				= $page;
        $limit 					= 5;
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;
        //return 1;
        $date = date('Y-m-d');
        //return $date;
        //return $txt;

        if($txt!='' && $txt!= null && $txt!='a'){
            $publication = DB::table('publications as p')
                ->where('p.status',1)
                ->where("p.publication_title","like","%".$txt."%")
                ->orWhere("p.details","like","%".$txt."%")
                ->select('p.id','p.publication_title as title', 'p.details',DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'), 'p.publication_type as type')
                ->groupBy('p.id')
                ->orderBy('p.created_at','desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }
        else{
            $publication = DB::table('publications as p')
                ->where('p.status',1)
                ->select('p.id','p.publication_title as title', 'p.details',DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'), 'p.publication_type as type')
                ->groupBy('p.id')
                ->orderBy('p.created_at','desc')
                ->offset($start)
                ->limit($end)
                ->get();
        }



        return json_encode($publication);
    }

    public function publicationsDtails($id){
        $publication = DB::table('publications as p')
            ->where('p.id',$id)
            ->select('p.id','p.publication_title as title', 'p.details','p.publication_type','p.authors','p.attachment',DB::Raw('from_unixtime(UNIX_TIMESTAMP(created_at)) as created_at'), 'p.publication_type as type')
            ->get();

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        Notification::where([['to_id',$user_info['id']],['module_id',38],['module_reference_id',$publication[0]->id]])->update(['status'=>1]);


        return json_encode($publication);
    }

    public function userMessage(Request $r){
	    //return '1';

        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();
        $group_id               =$_POST['group_id'];
        $app_user_id_load_msg 	= $user_info['id'];
        $page_no 				= $_POST['page_no'];
        $limit 					= $_POST['limit'];
        $message_load_type		= $_POST['message_load_type'];
        $last_message_id	= $_POST['last_message_id'];
        $start = ($page_no*$limit)-$limit;
        $end   = $limit;

        $category = $this->language==='en'? 'mc.category_name as category_name': 'mc.category_name_bn as category_name';

        //$group = $this->language==='en'? 'group_name as group_name': 'group_name_bn as group_name';
        if(isset($group_id) && $group_id==0){
            MessageMaster::where([['app_user_id',$app_user_id_load_msg],['is_group_msg',0]])->whereNotNull('admin_id')->update(['is_seen'=>1]);
        }else{
            MessageMaster::where([['app_user_id',$app_user_id_load_msg],['group_id',$group_id]])->whereNotNull('admin_id')->update(['is_seen'=>1]);
        }
        //return $start;

/*echo DB::table('message_masters as mm')
                ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
                ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
                ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
                ->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                ->leftJoin('app_user_group_members as augm', function($leftJoin)
                {
                    $leftJoin->on('augm.group_id', '=', 'mm.group_id')
                        ->where('augm.status', '=', 1 );
                })
                ->where('mm.group_id','=',$group_id)
                ->where(function ($query) {
                    $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

                    $query->where('augm.app_user_id',$user_info['id'])
                        ->orWhere('mm.app_user_id',$user_info['id']);
                })
                ->where('mm.status','!=',0)
                // condition: and ((group_id!="" AND group_id = 4)
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.admin_message AS reply_message', 'reply.app_user_message AS reply_app_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'),
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name','mm.group_id')
                ->groupBy('mm.id')
                ->orderBy('mm.message_date_time', 'desc')
                ->offset($start)
                ->limit($end)
				->toSql();die;*/




        if($message_load_type ==1 || $message_load_type ==3){
            $message = DB::table('message_masters as mm')
                ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
                ->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
                ->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
                ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
                ->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                ->leftJoin('app_user_group_members as augm', function($leftJoin)
                {
                    $leftJoin->on('augm.group_id', '=', 'mm.group_id')
                        ->where('augm.status', '=', 1 );
                })
                ->where('mm.group_id','=',$group_id)
                ->where(function ($query) {
                    $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

                    $query->where('augm.app_user_id',$user_info['id'])
                        ->orWhere('mm.app_user_id',$user_info['id']);
                })
                ->where('mm.status','!=',0)
                // condition: and ((group_id!="" AND group_id = 4)
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.admin_message AS reply_message', 'reply.app_user_message AS reply_app_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'),
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', $category,'mm.group_id')
                ->groupBy('mm.id')
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
                ->leftJoin('app_user_group_members as augm', function($leftJoin)
                {
                    $leftJoin->on('augm.group_id', '=', 'mm.group_id')
                        ->where('augm.status', '=', 1 );
                })
                ->where('mm.group_id','=',$group_id)
                ->where(function ($query) {
                    $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

                    $query->where('augm.app_user_id',$user_info['id'])
                        ->orWhere('mm.app_user_id',$user_info['id']);
                })

                ->where('mm.status','!=',0)
				->where('mm.id','>',$last_message_id)
                ->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.admin_message AS reply_message', 'reply.app_user_message AS reply_app_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'),
                    DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
                    DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
                    'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', $category)
                ->groupBy('mm.id')
                ->orderBy('mm.message_date_time', 'desc')
                ->get();
        }
		/*else if($message_load_type==4){
			$message = DB::table('message_masters as mm')
				->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
				->leftJoin('users as u', 'mm.admin_id', '=', 'u.id')
				->leftJoin('message_attachments as ma', 'mm.id', '=', 'ma.message_master_id')
				->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
				->leftJoin('message_masters as reply', 'reply.id', '=', 'mm.reply_to')
                ->leftJoin('app_user_group_members as augm', function($leftJoin)
                {
                    $leftJoin->on('augm.group_id', '=', 'mm.group_id')
                        ->where('augm.status', '=', 1 );
                })
                ->where('mm.group_id','=',$group_id)
                ->where(function ($query) {
                    $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

                    $query->where('augm.app_user_id',$user_info['id'])
                        ->orWhere('mm.app_user_id',$user_info['id']);
                })
				->where(function ($query) {
					$query->whereNotNull('mm.admin_message')
					->orWhere('mm.is_attachment', '>', 0);
				})
				->where('mm.status','!=',0)
				->where('mm.id','>',$last_message_id)
				->select('mm.id as id', 'mm.reply_to as replay_to_id', 'reply.admin_message AS reply_message','reply.app_user_message AS reply_app_message', 'mm.app_user_id as app_user_id', 'apu.user_profile_image','u.user_profile_image AS admin_image', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id','u.name AS admin_name', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'),
				DB::raw('group_concat( ma.app_user_attachment,"*",ma.attachment_type) AS app_user_attachment') ,
				DB::raw('group_concat( ma.admin_atachment,"*",ma.attachment_type) AS admin_atachment') ,
				'mm.is_attachment as is_attachment', 'ma.attachment_type as attachment_type', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name')
				->groupBy('id')
				->orderBy('mm.message_date_time', 'desc')
				->get();
		}*/



        return json_encode(array(
            "message"=>$message
        ));
	}

    public function deleteMessage($id){
        MessageMaster::where('id',$id)->update(['status'=>0]);
        return 1;
    }

    public function getMessageCategory(){
	    $category = $this->language==='en'? 'category_name as category_name': 'category_name_bn as category_name';
        $data = MessageCategory::select('id', $category)->get();
        return json_encode($data);
    }

    public function getMessageGroup(){
        $group = $this->language==='en'? 'ug.group_name as group_name': 'ug.group_name_bn as group_name';
        $user_info = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email)->first();

        //$data = UserGroup::where('type',2)->select('id', $group)->get();
        /*echo DB::table('user_groups as ug')
            ->leftJoin('app_user_group_members as augm','augm.group_id','=','ug.id')
            ->where('ug.type','=','2')
            ->where('augm.status','=',1)
            ->where('augm.app_user_id','=',$user_info['id'])
            ->select('ug.id',$group)
            ->toSql();die;
        */
        $data = DB::table('user_groups as ug')
            ->leftJoin('app_user_group_members as augm','augm.group_id','=','ug.id')
            ->where('ug.type','=','2')
            ->where('augm.status','=',1)
            ->where('augm.app_user_id','=',$user_info['id'])
            ->select('ug.id',$group)
            ->get();
            //echo $user_info['id'];die;
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
        $app_user_message = $r->admin_message;
        $group_id = $r->group_id;
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
            $new_msg->group_id = $group_id;
            $new_msg->is_seen = 0;

           // dd($new_msg);
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


    public function noticeList(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Notice";

        return view('frontend.notice', $data);
    }

	public function noticeDetail(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Notice";
        return view('frontend.detail-notice', $data);
    }

	public function publicationList(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Publication";
        return view('frontend.publication', $data);
    }

	public function publicationDetail(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Publication";
        return view('frontend.detail-publication', $data);
    }

	public function notificationList(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Notification";
        return view('frontend.notification', $data);
    }

	public function courseList(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Course";
        return view('frontend.course', $data);
    }

	public function surveyList(){
        $data['page_title'] = $this->page_title;
		$data['module_name']= "Survey";
        return view('frontend.survey', $data);
    }

    public function courseRegistration(){
        $data['page_title'] = $this->page_title;
        $data['module_name']= "Course registration";
        //$data['id']=$id;
        return view('frontend.course_registration', $data);
    }

    public function surveyQuestion(){
	    //return 1;

	    $data['page_title'] = $this->page_title;
        $data['module_name']= "Course registration";
        //$data['id']=$id;
        return view('frontend.survey_question', $data);
    }



}
