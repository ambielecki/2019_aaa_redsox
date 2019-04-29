<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    protected $fillable = ['type', 'location', 'start_time', 'details'];

    const TYPE_GAME = 'game';
    const TYPE_PRACTICE = 'practice';

    const TYPE_DESCRIPTIONS = [
        self::TYPE_GAME => 'Game',
        self::TYPE_PRACTICE => 'Practice',
    ];
}
