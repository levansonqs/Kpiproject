<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";
    protected $fillable=[
        'content','task_id','member_id',
    ];
}
