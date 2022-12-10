<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
            DB::table('users')->insert([
                'name' =>'Jose Rui Sumner Borda Hurtado',
                'email' =>'bordarui@gmail.com',
                'password' => Hash::make('MyPassword'),
                'type' => 'ADMIN',
            ]);
    }
}
