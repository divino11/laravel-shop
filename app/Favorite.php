<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected  $primaryKey = 'user_id';

    protected $fillable = [
        'user_id',
        'product_id'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'favorites', 'user_id', 'product_id')->withTimeStamps();
    }
}
