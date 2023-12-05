<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainPage extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'main_banner',
        'main_banner_mobile',
        'second_banner',
        'second_banner_mobile',
        'third_banner',
        'third_banner_mobile'
    ];
}
