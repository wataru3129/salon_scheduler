<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ReservationSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('reservations')->insert([
            'user_id' => 1,
            'customer_id' => 1,
            // 'guest_name',
            'content' => 'test,test,test,test',
            'start_time' => '2022/05/05 11:00:00',
            'end_time' => '2022/05/05 12:00:00',
        ]);
    }
}
