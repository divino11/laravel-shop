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

    /**
     * Determine whether a post has been marked as favorite by a user.
     *
     * @return boolean
     */
    public function favorited()
    {
        return (bool) Favorite::where('user_id', Auth::id())
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
}
