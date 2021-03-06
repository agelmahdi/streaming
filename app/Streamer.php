<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Streamer extends Authenticatable implements JWTSubject
{
    use Notifiable;
//    use HasRoles;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name_ar','name_en','slug_ar','slug_en','address_ar','address_en','details_ar','details_en','phone','email','gender','city_id','image', 'password',
    ];

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


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     * @return mixed
     */
    public function quizes()
    {
        return $this->hasMany('App\Quiz');
    }
    public function getJWTIdentifier()
    {
        // TODO: Implement getJWTIdentifier() method.
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        // TODO: Implement getJWTCustomClaims() method.
        return [];
    }
    public function AcademicYears()
    {
        return $this->belongsToMany('App\AcademicYear');
    }
    public function Subjects()
    {
        return $this->belongsToMany('App\Subject','subject_streamer');
    }
    public function Followers()
    {
        return $this->belongsToMany('App\Follower','streamer_follower','streamer_id');
    }
}
