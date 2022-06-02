<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert(
            [
                [
                    'name' => 'test',
                    'email' => 'test@test.com',
                    'password' => Hash::make('password'),
                    'created_at' => '2022/05/05 11:11:11',
                    'role' => 9,
                ],
                [
                    'name' => 'test02',
                    'email' => 'test02@test.com',
                    'password' => Hash::make('password'),
                    'created_at' => '2022/05/05 11:11:11',
                    'role' => 9,
                ],
                [
                    'name' => 'test03',
                    'email' => 'test03@test.com',
                    'password' => Hash::make('password'),
                    'created_at' => '2022/05/05 11:11:11',
                    'role' => 9,
                ],
            ]
        );
    }
}
