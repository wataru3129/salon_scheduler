<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Reservation;

class ReservationService {

  public static function checkReservationDuplication($eventDate, $startDate, $endDate) {

    return DB::table('reservations')
      ->whereDate('start_time', $eventDate)
      ->whereTime('end_time', '>', $startDate)
      ->whereTime('start_time', '<', $endDate)
      ->exists();
  }

  public static function joinDateAndTime($date, $time) {
    $joinedDate = $date . ' ' . $time;

    return Carbon::createFromFormat('Y-m-d H:i', $joinedDate);
  }
}
