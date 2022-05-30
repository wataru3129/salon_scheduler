<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;


class Reservation extends Model {
    use HasFactory;

    protected $fillable = [
        // 'name',
        // 'guest_name',
        'content',
        'date',
        'start_time',
        'end_time',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
