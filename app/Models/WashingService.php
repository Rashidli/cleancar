<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WashingService extends Model
{
    use HasFactory;
    protected $table = 'washing_services';
    public $timestamps = false;
}
