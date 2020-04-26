<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    public function trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
