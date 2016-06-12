<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    protected $primaryKey = 'id';
    protected $fillable = array('name', 'chat_id');
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User', 'group_user', 'group_id', 'user_id');
    }

    public function reports()
    {
        return $this->hasMany('App\Report', 'group_id', 'id');
    }
}
