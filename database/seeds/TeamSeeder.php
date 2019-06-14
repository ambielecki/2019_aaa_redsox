<?php

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Team::create([
            'name' => 'Red Sox',
            'year' => 2019,
            'division_id' => 3,
            'is_active' => 1,
        ]);

        Team::create([
            'name' => 'Dodgers',
            'year' => 2019,
            'division_id' => 3,
            'is_active' => 1,
        ]);

        Team::create([
            'name' => 'Athletics',
            'year' => 2019,
            'division_id' => 3,
            'is_active' => 1,
        ]);

        Team::create([
            'name' => 'Marlins',
            'year' => 2019,
            'division_id' => 3,
            'is_active' => 1,
        ]);
    }
}
