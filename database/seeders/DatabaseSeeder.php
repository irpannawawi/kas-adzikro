<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\Akun;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['kode_akun' => '100','nama_akun' => 'Donasi'],   
            ['kode_akun' => '100-10','nama_akun' => 'Penyewaan'],    
            ['kode_akun' => '100-20','nama_akun' => 'Kas'],  
            ['kode_akun' => '200-10','nama_akun' => 'Piutang'],  
            ['kode_akun' => '200-20','nama_akun' => 'Hutang'],
        ];
        Akun::insert($data);
    }
}
