<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionTranslation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title','ban','service','suggestion_id','locale'];
}
