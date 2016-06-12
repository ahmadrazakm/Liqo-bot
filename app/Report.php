<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'report';
    protected $primaryKey = 'id';
    protected $fillable = array('user_id', 'group_id', 'date', 'time');
    protected $dates = array('date', 'time');
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo('App\Group');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
