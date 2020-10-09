<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'role_id', 'email', 'password',              //modify gareko
    ];

    // protected $guarded = [];                 // yo mathi ko fillable ko alternative yesari guarded pani use  garna sakinxa

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    Public function role()
    {
        return $this->belongsTo( Role::class );
    }


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $route = $this->role->nickname == 'admin' ? 'admin.password.reset' : 'password.reset';

        $this->notify(new ResetPasswordNotification($route, $token));                   // yo line ko ResetPasswordNotification  class lai aru class jasto sajilari right click garera import garna mildaina.. yeslai terminal ko  help batw garna parcha
    }

}
