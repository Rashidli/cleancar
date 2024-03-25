<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{

    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title','content', 'slug'];
    protected $fillable = ['image'];

    public function washings()
    {
        return $this->belongsToMany(Washing::class,'washing_services')->withPivot('ban_id','price');
    }



}
