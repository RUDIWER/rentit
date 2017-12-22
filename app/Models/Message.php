<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = ['id'];  // (RW) Protect model to be mass filled but make all fields filleable except id !!!

    public function sender()
    {
        return $this->belongsTo('App\Models\User', 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\User', 'receiver_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }
}
