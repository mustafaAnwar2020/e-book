<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }


    public function books()
    {
        return $this->belongsToMany('App\Models\Book', 'table_books_orders')->withPivot('quantity');
    }

    /**
     * Get the cart t the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }
}
