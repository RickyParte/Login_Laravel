<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name'=>'Ricky',
            'email'=>'partericky43@gmail.com',
            'password'=>Hash::make('ricky'),
            'confirmpassword'=>Hash::make('ricky')
        ]);
        DB::table('users')->insert([
            'name'=>'FS19IF043',
            'email'=>'fs19if043@gmail.com',
            'password'=>Hash::make('ricky'),
            'confirmpassword'=>Hash::make('ricky')
        ]);
    }
}
