<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Book extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['bio'];
    protected $guarded = [];
}
