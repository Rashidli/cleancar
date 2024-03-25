<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    use HasFactory;
    protected $fillable = ['reservation_id', 'status', 'user_id', 'user_type'];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
