<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Region extends Model
{

    protected $table = 'regions';
    use HasFactory, Translatable;
    public $translatedAttributes = ['title'];
    protected $guarded = [];

    public function children(): HasMany
    {
        return $this->hasMany(Region::class,'parent_id','id');
    }

    public function regions(): HasMany
    {
        return $this->children()->where('type',\App\Enums\Region::REGION);
    }

    public function villages(): HasMany
    {
        return $this->children()->where('type',\App\Enums\Region::VILLAGE);
    }

//    public function aa()
//    {
//        $cities = Region::with('regions.villages')->where('parent_id',null)->where('type',\App\Enums\Region::CITY)->get();
//    }


}
