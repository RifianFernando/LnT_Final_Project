<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $table = "products";
    protected $fillable = [
        'name',
        'category',
        'quantity',
        'image',
        'price'
    ];

    public function user() {
        return $this->hasMany(User::class);
    }
}
