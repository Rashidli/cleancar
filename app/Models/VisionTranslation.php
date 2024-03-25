<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionTranslation extends Model
{

    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['title','vision_id','locale','content'];

}
