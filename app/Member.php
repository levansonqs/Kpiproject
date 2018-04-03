<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table="members";
    protected $fillable=[
        'user_id','project_id','task_id','group_id'
    ];
    public function group(){
        return $this->belongsTo('App\Group');
    }
    public function task(){
        return $this->belongsTo('App\Member');
    }
    public function project(){
        return $this->belongsTo('App\Project');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }

}
