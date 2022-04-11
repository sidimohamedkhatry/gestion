<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'admin@admin.com',
            'password'   => bcrypt('123456')
        ]);

        $user->attachRole('super_admin');

    }//end of run
}//end of seeder
