<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('clients')->truncate();
        DB::table('clients')->insert([
            [
                'name' => 'Nguyen Anh Tu',
                'email' => 'kinganhtu@gmail.com',
                'phone' => '01234567891',
                'address' => 'Hà Nội',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Anh Tu 1',
                'email' => 'kinganhtu@gmail1.com',
                'phone' => '01234567891',
                'address' => 'Hà Nội',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nguyen Anh Tu 2',
                'email' => 'kinganhtu@gmail2.com',
                'phone' => '01234567891',
                'address' => 'Hà Nội',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
