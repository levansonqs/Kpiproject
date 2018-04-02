<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table="members";
    protected $fillable=[
        'user_id','project_id','task_id',
    ];
}
