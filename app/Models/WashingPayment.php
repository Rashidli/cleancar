<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WashingPayment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'washing_payments';
}
