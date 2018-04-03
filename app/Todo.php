<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $table="todos";
    protected $fillable=[
        'content','task_id',
    ];
    public function task(){
        return $this->belongsTo('App\Task');
    }

}
