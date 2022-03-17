<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','address','phone','contact'];
    protected $table = 'profiles';

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
