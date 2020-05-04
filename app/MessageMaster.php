<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageMaster extends Model
{
    protected $table = 'message_masters';

    protected $fillable = [
        'message_id', 'reply_to', 'is_group_msg' ,'admin_id','group_id' , 'admin_message', 'app_user_id', 'app_user_message', 'is_seen', 'message_category', 'message_date_time', 'attachment', 'status', 'is_attachment',
    ];


    public function messageCategory()
    {
        return $this->hasOne('App\MessageCategory','message_category');
    }
}
