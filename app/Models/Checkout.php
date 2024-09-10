<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = ['user_id', 'total_price', 'checkout_date'];

    public function checkoutItems()
    {
        return $this->hasMany(CheckoutItem::class);
    }
}

