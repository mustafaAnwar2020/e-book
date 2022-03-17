<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Book extends Model
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['name','bio'];
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo('App\Models\category');
    }

    /**
     * The roles that belong to the Book
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function authors()
    {
        return $this->belongsToMany('App\Models\Author', 'authors_books');
    }

}
