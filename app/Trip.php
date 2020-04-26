<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = ['name'];

    public function catchables(): HasMany
    {
        return $this->hasMany(Catchable::class);
    }
}
