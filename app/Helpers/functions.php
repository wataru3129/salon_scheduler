<?php

use Carbon\Carbon;

function dayOfWeekJapanese($date) {
  $dayOfWeek = Carbon::parse($date)->dayOfWeek;

  switch ($dayOfWeek) {
    case 0:
      $dayOfWeek = '日';
      break;
    case 1:
      $dayOfWeek = '月';
      break;
    case 2:
      $dayOfWeek = '火';
      break;
    case 3:
      $dayOfWeek = '水';
      break;
    case 4:
      $dayOfWeek = '木';
      break;
    case 5:
      $dayOfWeek = '金';
      break;
    case 6:
      $dayOfWeek = '土';
      break;
  }

  return $dayOfWeek;
}
