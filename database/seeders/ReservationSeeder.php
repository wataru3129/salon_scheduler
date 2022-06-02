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
            [
                'user_id' => 1,
                'customer_id' => 1,
                // 'guest_name',
                'content' => 'test,test,test,test',
                'start_time' => '2022/06/05 11:00:00',
                'end_time' => '2022/06/05 12:00:00',
            ],
            [
                'user_id' => 1,
                'customer_id' => 1,
                // 'guest_name',
                'content' => 'test,test,test,test',
                'start_time' => '2022/06/08 11:00:00',
                'end_time' => '2022/06/08 12:00:00',
            ],
            [
                'user_id' => 2,
                'customer_id' => 6,
                // 'guest_name',
                'content' => 'test,test,test,test',
                'start_time' => '2022/06/06 11:00:00',
                'end_time' => '2022/06/06 12:00:00',
            ],
            [
                'user_id' => 3,
                'customer_id' => 11,
                // 'guest_name',
                'content' => 'test,test,test,test',
                'start_time' => '2022/06/07 11:00:00',
                'end_time' => '2022/06/07 12:00:00',
            ]
        ]);
    }
}
