<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProduct extends Model
{
    protected $table = 'order_product';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
