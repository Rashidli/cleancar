<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
class BlogTranslation extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','blog_id','locale','content', 'slug'];

}
