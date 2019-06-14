<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {
    protected $fillable = ['name', 'year', 'division_id', 'is_active'];

    const TEAM_RED_SOX = 'red_sox';
    const TEAM_DODGERS = 'dodgers';
    const TEAM_MARLINS = 'marlins';
    const TEAM_AS = 'as';

    const TEAM_DESCRIPTIONS = [
        self::TEAM_RED_SOX => 'Red Sox',
        self::TEAM_DODGERS => 'Dodgers',
        self::TEAM_MARLINS => 'Marlins',
        self::TEAM_AS => "A's",
    ];


}
