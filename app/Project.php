<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','dealine','member_id','permission_id','description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    public function member(){
        return $this->belongsTo('App\Member');
    }
    public function boards(){
        return $this->hasMany('App\Board');
    }
    public function permission(){
        return $this->belongsTo('App\Permission');
    }

}
