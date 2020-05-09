<?php

namespace App\Http\Controllers;

use App\Notification;
use DB;


use Illuminate\Http\Request;

class NotificationController extends Controller
{
    //
    public function newNotificationLoad(){
        $notifications = DB::table('notifications as nf')
            ->leftJoin('app_users as apu', 'nf.from_id', '=', 'apu.id')
            ->where('nf.status',0)
            ->where('nf.to_user_type','Admin')
            ->select('nf.id as id', 'nf.from_id as app_user_id', 'nf.notification_title as notification',DB::Raw('from_unixtime(UNIX_TIMESTAMP(nf.created_at)) as created_at'), 'nf.message as details',  'apu.name as app_user_name','apu.user_profile_image')
            ->groupBy('nf.id')
            ->orderBy('nf.created_at', 'desc')
            ->get();

        return json_encode($notifications);
    }

    public function viewNotification($id){
        Notification::where('id',$id)->update(['status'=>1]);
        $notification =  Notification::where('id',$id)->get();
        return json_encode($notification);
    }
}
