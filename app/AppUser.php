<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppUser extends Model
{
    protected $table = 'app_users';
    
    protected $fillable = [
        'name','nid_no','email','contact_no','status','address','password','remarks', 'user_profile_image',
    ];
	
	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
	
	    /**
     * Change login status according to $status.
     *
     * @param string $status
     * @return mixed
     */

    public static function LogInStatusUpdate($status)
    {
        if(\Auth::check()){
            if($status=='login') {
                $change_status=1;
            } else {
                $change_status=0;
            }
            $loginstatuschange = \App\AppUser::where('email',\Auth::customer()->email)->update(array('login_status'=>$change_status));
            return $loginstatuschange;
        }
    }
}
