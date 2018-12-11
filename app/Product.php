<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded = [];
   // protected $with = ['categories'];
    //
    public function categories()
    {
        return $this->belongsToMany(Categories::class);
    }

}
