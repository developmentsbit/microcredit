<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\admin_main_menu;

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
            'name'=>Str::random(10),
            'email'=>'info@sbit.com.bd',
            'password'=>Hash::make('123'),
        ]);

        // admin_main_menu::create([
        //     'name'=>Str::random(10),
        //     'email'=>'info@sbit.com.bd',
        //     'password'=>Hash::make('123'),
        // ]);
    }
}
