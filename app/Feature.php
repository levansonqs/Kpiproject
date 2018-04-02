<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table="features";
    protected $fillable=[
      'name','description','project_id',
    ];
    public function project(){
        return $this->belongsTo('App\Project');
    }
    public function tasks(){
        return $this->hasMany('App\Task');
    }
}
