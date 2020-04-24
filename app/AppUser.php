<?php
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppUser extends Authenticatable
{
	 
	protected $guard = 'appUser';
    protected $table = 'app_users';
    
    protected $fillable = [
        'name','nid_no','email','contact_no','address','status','remarks', 'user_profile_image', 'user_type',
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
		/*$loginstatuschange = \App\AppUser::where('email',\Auth::guard('appUser')->user()->email )->update(array('login_status'=>$change_status));
		return $loginstatuschange;*/
		return 1;        
    }
}
