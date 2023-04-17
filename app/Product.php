<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['user_id','name','image','price','discount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
