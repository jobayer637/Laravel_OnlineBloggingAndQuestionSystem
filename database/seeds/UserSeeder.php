<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'role_id'=>1,
          'name'=>'Admin',
          'email'=>'admin@gmail.com',
          'password'=>bcrypt("jobayer21"),
        ]);

        DB::table('users')->insert([
          'role_id'=>2,
          'name'=>'Author',
          'email'=>'author@gmail.com',
          'password'=>bcrypt('jobayer21'),
        ]);
    }
}
