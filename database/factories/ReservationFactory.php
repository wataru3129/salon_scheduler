<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function definition() {

        $availableHour = $this->faker->numberBetween(9, 19);
        $minutes = [0, 10, 20, 30, 40, 50];
        $mKey = array_rand($minutes);
        switch ($availableHour) {
            case 19:
                $addHour = 1;
                break;
            case 18:
                $addHour = $this->faker->numberBetween(1, 2);
                break;
            default:
                $addHour = $this->faker->numberBetween(1, 3);
        }


        $dummyDate = $this->faker->dateTimeThisMonth('+1 month');
        $startDate = $dummyDate->setTime($availableHour, $minutes[$mKey]);
        $clone = clone $startDate;


        $endDate = $clone->modify('+' . $addHour . 'hour');

        $customerId = $this->faker->numberBetween(1, 20);
        $userId = Customer::findOrFail($customerId)->user_id;

        return [
            'user_id' => $userId,
            'customer_id' => $customerId,
            'content' => $this->faker->realText,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
