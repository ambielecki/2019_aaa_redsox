<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Division extends Model {
    protected $fillable = ['name', 'description', 'minimum_age', 'maximum_age', 'is_active'];
}
