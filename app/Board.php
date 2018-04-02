<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table="boards";
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
