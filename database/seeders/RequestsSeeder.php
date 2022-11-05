<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Seeder;
use App\Models\User;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Lesia Igorivna',
            'email' => 'lesia@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Donetsk',
            'moved_to_city' => 'Lviv'
        ]);
        $user->assignRole('refugee');

        Request::create([
               'refugee_id' => $user->id,
               'worker_id' => 1,
               'type' => 'shelter',
               'title' => 'Need place to stay',
               'status' => 'pending',
               'number_of_people' => 2
        ]);
    }
}
