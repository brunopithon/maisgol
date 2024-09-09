<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Group;
use App\Models\Coach;
use App\Models\Field;
use App\Models\Athlete;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Mais Gol',
            'email' => 'maisgol@gmail.com',
            'password' => '12345678'
        ]);

        Group::create(['name' => 'Grupo A', 'status' => 'active']);
        Group::create(['name' => 'Grupo B', 'status' => 'active']);
        Group::create(['name' => 'Grupo C', 'status' => 'active']);
        Group::create(['name' => 'Grupo D', 'status' => 'active']);

        Coach::factory(4)->create();

        Field::create([
            'name' => 'Campo 1',
            'timetable' => json_encode([
                'monday' => '08:00-18:00',
                'tuesday' => '08:00-18:00'
            ]),
        ]);

        Field::create([
            'name' => 'Campo 2',
            'timetable' => json_encode([
                'wednesday' => '08:00-18:00',
                'thursday' => '08:00-18:00'
            ]),
        ]);

        Field::create([
            'name' => 'Campo 3',
            'timetable' => json_encode([
                'friday' => '08:00-18:00',
                'saturday' => '08:00-14:00'
            ]),
        ]);

        Field::create([
            'name' => 'Campo 4',
            'timetable' => json_encode([
                'sunday' => '08:00-12:00'
            ]),
        ]);

        Athlete::factory(15)->create([
            'group_id' => 1,
        ]);

        Athlete::factory(15)->create([
            'group_id' => 2,
        ]);

        Athlete::factory(15)->create([
            'group_id' => 3,
        ]);

        Athlete::factory(15)->create([
            'group_id' => 4,
        ]);
    }
}
