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

function roundTime($time) {

  // 時刻をUnix秒に変換
  $seconds = strtotime(Carbon::parse($time));

  // 10分単位で四捨五入
  $roundedSeconds = round($seconds / (10 * 60)) * (10 * 60);

  $roundedTime = date('H:i', $roundedSeconds);
  return $roundedTime;
}
