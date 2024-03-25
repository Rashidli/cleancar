<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title','duration'];
    protected $fillable = ['price'];

    public function washings()
    {
        return $this->belongsToMany(Washing::class, 'washing_payments')->withPivot('is_payed');
    }
}
