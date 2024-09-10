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

        Coach::factory(4)->create([
            'timetable' =>
                '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}'
        ]);

        Field::create([
            'name' => 'Campo 1',
            'timetable' =>
                '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}'
        ]);

        Field::create([
            'name' => 'Campo 2',
            'timetable' =>
                '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}'
        ]);

        Field::create([
            'name' => 'Campo 3',
            'timetable' =>
                '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}'
        ]);

        Field::create([
            'name' => 'Campo 4',
            'timetable' =>
                '{"monday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"tuesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"wednesday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"thursday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"friday":{"9":true,"10":true,"11":true,"13":true,"14":true,"15":true},"saturday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false},"sunday":{"9":false,"10":false,"11":false,"13":false,"14":false,"15":false}}'
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
