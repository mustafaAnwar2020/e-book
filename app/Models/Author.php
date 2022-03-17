<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Author extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name','bio'];
    protected $guarded = [];



    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'authors_books');
    }
}
