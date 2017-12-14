<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageHeader extends Model
{
    protected $guarded = ['id'];  // (RW) Protect model to be mass filled but make all fields filleable except id !!!
}
