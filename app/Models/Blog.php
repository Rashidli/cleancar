<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class Blog extends Model
{
    use Translatable, SoftDeletes;

    public $translatedAttributes = ['title', 'content', 'slug'];
    protected $fillable = ['image'];

//    public function getSlugOptions(): SlugOptions
//    {
//        return SlugOptions::create()
//            ->generateSlugsFrom('title')
//            ->saveSlugsTo('slug')
//            ->doNotGenerateSlugsOnUpdate();
//    }
}
