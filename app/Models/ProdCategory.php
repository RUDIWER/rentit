<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdCategory extends Model
{
    protected $guarded = ['id'];  // (RW) Protect model to be mass filled but make all fields filleable except id !!!

    
    public function childs() {
        return $this->hasMany('App\ProdCategory','parent_id','id') ;
    }
}


