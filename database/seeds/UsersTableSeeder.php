<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'id' => 1,
          'name' => 'ブルー',
          'username' => 'blue-travel',
          'email' => 'blue-travel@gmail.com',
          'age' => 28,
          'gender' => '男性',
          'employ' => '業務委託',
          'password' => bcrypt('blue1234'),
        ]);
    }
}
