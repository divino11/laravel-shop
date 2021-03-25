<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    //protected  $primaryKey = 'user_id';



    public function products()
    {
        return $this->belongsToMany(Product::class, 'favorites', 'id', 'product_id')->withTimeStamps();
    }
}
