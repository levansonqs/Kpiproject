<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table="tasks";
    protected $fillable=[
        'title','dealine','board_id','user_id'
    ];
    public function board(){
        return $this->belongsTo('App\Board');
    }
    public function todos(){
        return $this->hasMany('App\Todo');
    }
    public function user(){
        return $this->belongsToMany('App\User');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
