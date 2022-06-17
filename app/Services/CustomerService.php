<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;

class CustomerService {

  public static function customerCheck($userId, $customerName) {

    return Customer::where('user_id', $userId)
      ->where('name', $customerName)
      ->exists();
  }

  public static function customerSet($customer_name) {
    if ($customer_name == null) {
      $customer_name = '設定なし';
    }
    $customerCheck = self::customerCheck(Auth::id(), $customer_name);

    if (!$customerCheck) {
      Customer::create([
        'name' => $customer_name,
        'user_id' => Auth::id(),
      ]);
    }
    return Customer::where('name', $customer_name)->first()->id;
  }
}
