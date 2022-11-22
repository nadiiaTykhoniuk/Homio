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

        $user = User::create([
            'name' => 'Ivan Koolichka',
            'email' => 'koolivan@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Dnipro',
            'moved_to_city' => 'Ivano-Frankivsk'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'shelter',
            'title' => 'Need place to stay',
            'status' => 'pending',
            'number_of_people' => 7
        ]);

        $user = User::create([
            'name' => 'Maryna Yanenko',
            'email' => 'maryane@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Crimea',
            'moved_to_city' => 'Chernivtsi'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'medicine',
            'title' => 'Need medicine from diabetes',
            'status' => 'pending',
            'number_of_people' => 1
        ]);

        $user = User::create([
            'name' => 'Andrii Lorak',
            'email' => 'lorak@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Lugansk',
            'moved_to_city' => 'Lviv'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'food',
            'title' => 'Need food for my children',
            'status' => 'closed',
            'number_of_people' => 3
        ]);

        $user = User::create([
            'name' => 'Iryna Lytruk',
            'email' => 'litune@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Lugansk',
            'moved_to_city' => 'Ivano-Frankivsk'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'food',
            'title' => 'Need food for my pets',
            'status' => 'pending',
            'number_of_people' => 1
        ]);

        $user = User::create([
            'name' => 'Maria Fedyshyn',
            'email' => 'fedmaria@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Kyiv',
            'moved_to_city' => 'Lviv'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'shelter',
            'title' => 'Shelter for old person',
            'status' => 'pending',
            'number_of_people' => 1
        ]);

        $user = User::create([
            'name' => 'Yaroslav Kynitski',
            'email' => 'yarotsi@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Kyiv',
            'moved_to_city' => 'Ivano-Frankivsk'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'medicine',
            'title' => 'Need to stay at hospital',
            'status' => 'closed',
            'number_of_people' => 1
        ]);

        $user = User::create([
            'name' => 'Loorak Anichka',
            'email' => 'loricka@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Donetsk',
            'moved_to_city' => 'Ivano-Frankivsk'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'clothes',
            'title' => 'Need clothes for 2 small children',
            'status' => 'opened',
            'number_of_people' => 3
        ]);

        $user = User::create([
            'name' => 'Petro Kevin',
            'email' => 'kepo@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Dnipro',
            'moved_to_city' => 'Chernivtsi'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'clothes',
            'title' => 'Need clothes for my mam, 78-year old woman',
            'status' => 'opened',
            'number_of_people' => 1
        ]);

        $user = User::create([
            'name' => 'Petro Irvin',
            'email' => 'kepopet@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Dnipro',
            'moved_to_city' => 'Lviv'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'shelter',
            'title' => 'Shelter for 11 children from school',
            'status' => 'pending',
            'number_of_people' => 11
        ]);

        $user = User::create([
            'name' => 'Ivanna Yatsyk',
            'email' => 'ivaya@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Mariupol',
            'moved_to_city' => 'Kyiv'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'hospital',
            'title' => 'Hospital for pregnant woman',
            'status' => 'pending',
            'number_of_people' => 1
        ]);

        $user = User::create([
            'name' => 'Ivan Loolol',
            'email' => 'ivaylool@gmail.com',
            'password' => bcrypt('password'),
            'moved_from_city' => 'Mariupol',
            'moved_to_city' => 'Kyiv'
        ]);
        $user->assignRole('refugee');

        Request::create([
            'refugee_id' => $user->id,
            'worker_id' => 1,
            'type' => 'food',
            'title' => 'Food for newborn baby',
            'status' => 'opened',
            'number_of_people' => 1
        ]);
    }
}
