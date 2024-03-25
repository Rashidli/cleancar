<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BanTranslation extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','ban_id','locale'];

}
