<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoiceUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'invoice',
        'product_category',
        'product_name',
        'product_quantity',
        'shipping_address',
        'postal_code',
        'total_price'
    ];

    public function users() {
        return $this->hasMany(User::class);
    }
}
