<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;

class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Request::create([
               'refugee_id' => User::create([
                   'name' => 'Lesia Igorivna',
                   'email' => 'lesia@gmail.com',
                   'password' => bcrypt('password'),
                   'moved_from_city' => 'Donetsk',
                   'moved_to_city' => 'Lviv'
               ])->id,
               'worker_id' => 1,
               'type' => 'shelter',
               'title' => 'Need place to stay',
               'status' => 'pending',
               'number_of_people' => 2
        ]);
    }
}
