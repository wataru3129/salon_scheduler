<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'guest_name',
        'content',
        'date',
        'start_time',
        'end_time',
    ];
}
