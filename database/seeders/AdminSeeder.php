<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            [
                'name' => 'システム管理者',
                'email' => 'super@admin.co.jp',
                'password' => Hash::make('password'),
                'created_at' => '2021/01/01 11:11:11',
                'role' => 1
            ]
        ]);
    }
}
