<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = ['name'];

    public function catchables()
    {
        return $this->hasMany(Catchable::class);
    }
}
