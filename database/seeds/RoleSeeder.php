<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->insert([
          'name'=>'Admin',
          'slug'=>md5('admin'),
      ]);

      DB::table('roles')->insert([
          'name'=>'Author',
          'slug'=>md5('author'),
      ]);
    }
}
