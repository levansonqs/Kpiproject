<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table="groups";
    protected $fillable=[
        'name','permission_id'
    ];

    public function permission(){
        return $this->belongsTo('App\Permission');
    }
}
