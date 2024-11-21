<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     /*   User::updateOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'first_name' => 'Admin',
            'last_name' => 'CA',
            'email'=>'admin@gmail.com',
            'password' => bcrypt('28744923')
        ]);
		
		*/
		  User::updateOrCreate([
            'email' => 'atilio@gmail.com'
        ], [
            'first_name' => 'Admin',
            'last_name' => 'CA',
            'email'=>'atilio@gmail.com',
            'password' => bcrypt('123456')
        ]);
    }
}
