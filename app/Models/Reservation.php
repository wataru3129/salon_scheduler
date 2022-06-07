<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;


class Reservation extends Model {
    use HasFactory;

    protected $fillable = [
        // 'name',
        // 'guest_name',
        'user_id',
        'customer_id',
        'content',
        // 'date',
        'start_date',
        'end_date',
    ];

    protected function reservedDate(): Attribute {
        return new Attribute(
            get: fn () => Carbon::parse($this->start_date)->format('m月d日')
        );
    }


    // protected function editReservedDate(): Attribute {
    //     return new Attribute(
    //         get: fn () => Carbon::parse($this->start_time)->format('Y-m-d')
    //     );
    // }

    protected function startTime(): Attribute {
        return new Attribute(
            get: fn () => Carbon::parse($this->start_date)->format('H時i分')
        );
    }

    protected function endTime(): Attribute {
        return new Attribute(
            get: fn () => Carbon::parse($this->end_date)->format('H時i分')
        );
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
