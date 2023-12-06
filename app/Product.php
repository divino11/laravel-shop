<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function categories()
    {
        return $this->hasMany(ProductCategory::class, 'product_id');
    }

    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function favorited()
    {
        return (bool) Favorite::where('user_id', session('favoriteId'))
            ->where('product_id', $this->id)
            ->first();
    }

    public function getPriceByCount()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_size');
    }

    public function colors()
    {
        return $this->belongsToMany(Color::class, 'product_color');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}
