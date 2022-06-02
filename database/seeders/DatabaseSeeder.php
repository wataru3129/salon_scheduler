<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Customer;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // \App\Models\User::factory(10)->create();

        // Customer::factory(10)->create();
        // Reservation::factory(100)->create();


        $this->call([
            UserSeeder::class,
            CustomerSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
