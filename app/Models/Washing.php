<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Washing extends Model
{
    protected $table = 'washings';
    protected $guarded  = [];
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Service::class, 'washing_services')->withPivot('ban_id', 'price');
    }


    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }

    public function images()
    {
        return $this->hasMany(WashingImage::class);
    }

    public function packages()
    {
        return $this->belongsToMany(Package::class, 'washing_payments')->withPivot('is_payed');
    }




}
