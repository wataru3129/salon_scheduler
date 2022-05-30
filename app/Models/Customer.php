<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;
use App\Models\User;

class Customer extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function reservation() {
        return $this->hasMany(Reservation::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
