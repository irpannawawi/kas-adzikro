<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([[
            'nama' => 'bendahara',
            'email' => 'bendahara@tes.com',
            'password' => Hash::make('password'),
            'level' => 'bendahara',
        ],[
            'nama' => 'Pimpinan',
            'email' => 'pimpinan@tes.com',
            'password' => Hash::make('password'),
            'level' => 'pimpinan',
        ]]);
    }
}
