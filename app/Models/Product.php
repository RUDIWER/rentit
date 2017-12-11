<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = ['id'];  // (RW) Protect model to be mass filled but make all fields filleable except id !!!

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

} 
