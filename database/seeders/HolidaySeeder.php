<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class HolidaySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('holidays')->insert([
            [
                'day_off' => '2022/06/05 00:00:00'
            ],
            [
                'day_off' => '2022/06/12 00:00:00'
            ],
            [
                'day_off' => '2022/06/19 00:00:00'
            ],
            [
                'day_off' => '2022/06/22 00:00:00'
            ],
            [
                'day_off' => '2022/06/27 00:00:00'
            ],
        ]);
    }
}
