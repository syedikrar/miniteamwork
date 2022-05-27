<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
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
      DB::table('users')->insertGetId([
          'id'                    => 1,
          'first_name'            => 'admin',
          'last_name'             => 'user',
          'email'                 => 'admin@test.com',
          'password'              => Hash::make('12345678')
      ]);
    }
}
