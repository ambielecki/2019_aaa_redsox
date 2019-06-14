<?php

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Division::create([
            'name' => 'TBall',
            'description' => 'TBall',
            'minimum_age' => 5,
            'maximum_age' => 6,
            'is_active' => 1,
        ]);

        Division::create([
            'name' => 'Rookie',
            'description' => 'Coach pitch',
            'minimum_age' => 7,
            'maximum_age' => 7,
            'is_active' => 1,
        ]);

        Division::create([
            'name' => 'AAA',
            'description' => 'Player pitch',
            'minimum_age' => 8,
            'maximum_age' => 8,
            'is_active' => 1,
        ]);

        Division::create([
            'name' => 'Minors',
            'description' => 'Player pitch, standings',
            'minimum_age' => 9,
            'maximum_age' => 11,
            'is_active' => 1,
        ]);

        Division::create([
            'name' => 'Majors',
            'description' => 'Player pitch, standings',
            'minimum_age' => 10,
            'maximum_age' => 12,
            'is_active' => 1,
        ]);
    }
}
