<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Division extends Model {
    protected $fillable = ['name', 'description', 'minimum_age', 'maximum_age', 'is_active'];

    public function teams(): HasMany {
        return $this->hasMany(Team::class);
    }
}
