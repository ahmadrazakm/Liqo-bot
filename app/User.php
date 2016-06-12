<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $fillable = array('id', 'username');
    public $timestamps = false;

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_user', 'user_id', 'group_id');
    }

    public function reports()
    {
        return $this->hasMany('App\Report', 'user_id', 'id');
    }
}
