<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $guarded = [];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
