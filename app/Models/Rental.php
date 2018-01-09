<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $guarded = ['id'];  // (RW) Protect model to be mass filled but make all fields filleable except id !!!

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

    public function renter()
    {
        return $this->belongsTo('App\Models\User', 'renter_id');
    }
}
