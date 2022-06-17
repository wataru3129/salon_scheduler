<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // DB::table('customers')->insert(
        //     [
        //         [
        //             'name' => 'test_customer01',
        //             'user_id' => 1,
        //         ],
        //         [
        //             'name' => 'test_customer02',
        //             'user_id' => 1,
        //         ],
        //         [
        //             'name' => 'test_customer03',
        //             'user_id' => 1,
        //         ],
        //         [
        //             'name' => 'test_customer04',
        //             'user_id' => 1,
        //         ],
        //         [
        //             'name' => 'test_customer05',
        //             'user_id' => 1,
        //         ],
        //         [
        //             'name' => 'test_customerB01',
        //             'user_id' => 2,
        //         ],
        //         [
        //             'name' => 'test_customerB02',
        //             'user_id' => 2,
        //         ],
        //         [
        //             'name' => 'test_customerB03',
        //             'user_id' => 2,
        //         ],
        //         [
        //             'name' => 'test_customerB04',
        //             'user_id' => 2,
        //         ],
        //         [
        //             'name' => 'test_customerB05',
        //             'user_id' => 2,
        //         ],
        //         [
        //             'name' => 'test_customerC01',
        //             'user_id' => 3,
        //         ],
        //         [
        //             'name' => 'test_customerC02',
        //             'user_id' => 3,
        //         ],
        //         [
        //             'name' => 'test_customerC03',
        //             'user_id' => 3,
        //         ],
        //         [
        //             'name' => 'test_customerC04',
        //             'user_id' => 3,
        //         ],
        //         [
        //             'name' => 'test_customerC05',
        //             'user_id' => 3,
        //         ],
        //     ]
        // );

        Customer::factory()->count(20)->create();
    }
}
