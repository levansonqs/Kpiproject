<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable=[
        'user_id','group_id'
    ];
    public function projects(){
        return $this->hasMany('App\Project');
    }
    public function group(){
        return $this->belongsTo('App\Group');
    }
}
