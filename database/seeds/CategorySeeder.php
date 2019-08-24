<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
          'name'=>'Programming',
          'slug'=>'programming'
        ]);

        DB::table('categories')->insert([
          'name'=>'Design',
          'slug'=>'desing'
        ]);

        DB::table('categories')->insert([
          'name'=>'Algorithm',
          'slug'=>'algorithm'
        ]);

        DB::table('categories')->insert([
          'name'=>'Data Structure',
          'slug'=>'data_structure'
        ]);

        DB::table('categories')->insert([
          'name'=>'Networking',
          'slug'=>'networking'
        ]);

        DB::table('categories')->insert([
          'name'=>'Others',
          'slug'=>'Others'
        ]);
    }
}
