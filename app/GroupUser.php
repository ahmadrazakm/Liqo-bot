<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    protected $table = 'group_user';
    protected $primaryKey = null;
    protected $fillable = array('user_id', 'group_id');
    public $timestamps = false;
    public $incrementing = false;

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
