<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalProduct extends Model
{
    use HasFactory;
    protected $table = 'total_products';
    protected $fillable = [
        'users_id',
        'products_id',
        'quantity'
    ];

    public function user() {
        return $this->hasMany(User::class);
    }

    public function product() {
        return $this->hasMany(Products::class);
    }
}
