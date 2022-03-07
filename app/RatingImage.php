<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RatingImage extends Model
{
    public function ratings()
    {
        return $this->belongsTo(Rating::class);
    }
}
