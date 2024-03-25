<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suggestion extends Model
{
    use HasFactory, Translatable, SoftDeletes;
    public $translatedAttributes = ['title','ban','service'];
    protected $fillable = ['price','branch'];
}
