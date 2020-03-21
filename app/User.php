<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function projects()
    {
        //many-to-many relationship
        return $this->belongsToMany('App\Project', 'programmers', 'programmer_id', 'project_id');
    } 

    public function applications()
    {
        //one-to-many relationship
        //user has many applications
        return $this->belongsToMany('App\Applicant');
    }
}
