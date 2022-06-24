<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Reservation;

class ReservationService {

  public static function checkReservationDuplication($reservationDate, $startDate, $endDate) {

    return DB::table('reservations')
      ->whereDate('start_date', $reservationDate)
      ->whereTime('end_date', '>', $startDate)
      ->whereTime('start_date', '<', $endDate)
      ->exists();
  }

  public static function checkReservationDuplicationExceptOwn($ownReservationId, $reservationDate, $startTime, $endTime) {
    $reservation = DB::table('reservations')
      ->whereDate('start_date', $reservationDate)
      ->whereTime('end_date', '>', $startTime)
      ->whereTime('start_date', '<', $endTime)
      ->get()
      ->toArray();

    // dd($reservation);

    // そもそも日付が重複していない
    if (empty($reservation)) {
      return false;
    }

    // 重複があったイベントのidを取得
    $reservationId = $reservation[0]->id;

    // dd($reservationId, $ownReservationId);

    // 重複していたイベントが自身の場合、重なっていないと判定
    if ($ownReservationId === $reservationId) {
      return false;
    } else {
      return true;
    }
  }


  public static function joinDateAndTime($date, $time) {
    $joinedDate = $date . ' ' . $time;

    return Carbon::createFromFormat('Y-m-d H:i', $joinedDate);
  }


  // public static function checkReservationOfTheDay($date){

  //   $

  //   $check = Reservation::
  // }
}
