<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table="tasks";
    protected $fillable=[
        'title','feature_id',
    ];
    public function feature(){
        return $this->belongsTo('App\Board');
    }
    public function members(){
        return $this->hasMany('App\Member');
    }
    public function todos(){
        return $this->hasMany('App\Todo');
    }
    public function comments(){
        return $this->hasMany('App\Comment');
    }
}
