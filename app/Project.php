<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table= 'projects';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function users(){
        return $this->belongsToMany('App\User','users');
    }
    public function boards(){
        return $this->hasMany("App\Board");
    }
    public function members(){
        return $this->hasMany("App\Member");
    }

}
