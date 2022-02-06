<?php

namespace App\Http\Controllers;
use App\UserGroup;
use Auth;
use Validator;
use Session;
use DB;
use App\Traits\HasPermission;
use Illuminate\Http\Request;
use App\Menu;
use App\Notification;
use App\AppUser;

use \App\System;
use \App\Setting;


class NotificationController extends Controller
{
    //
    use HasPermission;

    public function __construct(Request $request)
    {
        $this->page_title = $request->route()->getName();
        $description = \Request::route()->getAction();
        $this->page_desc = isset($description['desc']) ? $description['desc'] : $this->page_title;
    }

    public function newNotificationLoad(){
        $newMessage = array();
        $groupMessage = DB::table('message_masters as mm')
            ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->leftJoin('user_groups as ug', 'mm.group_id', '=', 'ug.id')
            ->where('mm.is_seen',0)
            ->where('mm.is_group_msg',1)
            ->whereNull('admin_message')
            ->where('is_attachment',0)
            ->select('mm.id as id', 'mm.app_user_id as app_user_id', 'mm.message_category as category_id', 'mm.group_id as group_id', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'), 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name', 'ug.group_name as group_name','apu.name as app_user_name', 'apu.user_profile_image')
            ->groupBy('mm.group_id', 'mm.message_category')
            ->orderBy('mm.created_at', 'desc')
            ->get();

        $individualMessage = DB::table('message_masters as mm')
            ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->where('mm.is_seen',0)
            ->where('mm.is_group_msg',0)
            ->whereNull('admin_message')
            ->where('is_attachment',0)
            ->select('mm.id as id', 'mm.app_user_id as app_user_id','mm.message_category as category_id', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'), 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name','apu.name as app_user_name','apu.user_profile_image')
            ->groupBy('mm.app_user_id')
            ->orderBy('mm.created_at', 'desc')
            ->get();
            
           /*echo  DB::table('message_masters as mm')
            ->leftJoin('app_users as apu', 'mm.app_user_id', '=', 'apu.id')
            ->leftJoin('message_categories as mc', 'mm.message_category', '=', 'mc.id')
            ->where('mm.is_seen',0)
            ->where('mm.is_group_msg',0)
            ->whereNull('admin_message')
            ->select('mm.id as id', 'mm.app_user_id as app_user_id','mm.message_category as category_id', 'mm.app_user_message as app_user_message', 'mm.admin_id as admin_id', 'mm.admin_message as admin_message',DB::Raw('from_unixtime(UNIX_TIMESTAMP(mm.created_at)) as msg_date'), 'mm.is_attachment as is_attachment', 'mm.admin_id as admin_id', 'mm.is_attachment_app_user as is_attachment_app_user', 'mc.category_name as category_name','apu.name as app_user_name','apu.user_profile_image')
            ->groupBy('mm.app_user_id')
            ->orderBy('mm.created_at', 'desc')->toSql();die; 
            
           */ 
            
        foreach ($individualMessage as $value){
            $newMessage[strtotime($value->msg_date)]=$value;
        }
        foreach ($groupMessage as $value){
            $newMessage[strtotime($value->msg_date)]=$value;
        }

        $notifications = DB::table('notifications as nf')
            ->leftJoin('app_users as apu', 'nf.from_id', '=', 'apu.id')
            ->where('nf.status',0)
            ->where('nf.to_user_type','Admin')
            ->select('nf.id as id', 'nf.from_id as app_user_id', 'nf.notification_title as notification',DB::Raw('from_unixtime(UNIX_TIMESTAMP(nf.created_at)) as created_at'), 'nf.message as details',  'apu.name as app_user_name','apu.user_profile_image')
            ->groupBy('nf.id')
            ->orderBy('nf.created_at', 'desc')
            ->get();
        
        $data['message']=$newMessage;
        $data['notification']=$notifications;

        return json_encode($data);
    }

    public function viewNotification($id){
        Notification::where('id',$id)->update(['status'=>1]);
        $notification =  Notification::where('id',$id)->get();
        return json_encode($notification);
    }

    public function allNotificationView(){

        $data['page_title'] = $this->page_title;
        $data['module_name']= "Notification";
        //action permissions
        $admin_user_id         = Auth::user()->id;
        $add_action_id         = 95;
        $add_permisiion        = $this->PermissionHasOrNot($admin_user_id,$add_action_id );
        $data['actions']['add_permisiion']= $add_permisiion;
        return view('notification.notification',$data);
    }

    public function allNotificationList(){
        $admin_user_id      = Auth::user()->id;
        $edit_action_id     = 95;
        $edit_permisiion    = 0;
        $delete_permisiion  = 0;
        //$data['module_name']= "Notification";


        /*echo MessageMaster::Select('id', 'admin_message', 'app_user_id', 'is_seen', 'status', 'message_category')
                        ->distinct('message_id')
                        ->whereNotNull('message_id')
                        ->orderBy('message_id','desc')
                        ->toSql();die;*/

        $notification_list = Notification::Select('id', 'notification_title', 'message', 'from_id', 'status', 'module_id','updated_at')
            ->distinct('id')
            ->where('to_user_type','Admin')
            ->orderBy('status','asc')
            ->groupBy('id')
            ->get();


        $return_arr = array();
        //return 1;
        foreach($notification_list as $data){
            if($data->module_id!=null){
                $module_name = Menu::select('module_name')->where('id',$data->module_id)->first();
                $data['module_name'] = $module_name['module_name'] ? $module_name['module_name']:'';
            }else{
                $data['module_name'] = '';
            }

            $app_user_name = AppUser::select('name')->where('id', $data->from_id)->first();

            $data['app_user_name'] = $app_user_name['name'];

            $data['is_seen']=($data->status == 1)?"<button class='btn btn-xs btn-success' disabled>Seen</button>":"<button  class='btn btn-xs btn-danger' disabled>Not-seen</button>";


            $data['actions']=" <button title='View' onclick='notification_view(".$data->id.")' id='view_" . $data->id . "' class='btn btn-xs btn-primary' ><i class='clip-zoom-in'></i></button>";

            if($edit_permisiion>0){
                $data['actions'] .=" <button title='Edit' onclick='edit_notification(".$data->id.")' id=edit_" . $data->id . "  class='btn btn-xs btn-green' ><i class='clip-pencil-3'></i></button>";
            }
            if ($delete_permisiion>0) {
                $data['actions'] .=" <button title='Delete' onclick='delete_notification(".$data->id.")' id='delete_" . $data->id . "' class='btn btn-xs btn-danger' ><i class='clip-remove'></i></button>";
            }
            $return_arr[] = $data;
        }
        return json_encode(array('data'=>$return_arr));
    }

    public function Notificationseen($id){

    }
}
