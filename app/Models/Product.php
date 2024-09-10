<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'type_id',
        'name',
        'stock',
        'description',
        'image',
        'buy_price',
        'sell_price',
        'expired_date',
    ];

    // Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }   

    public function checkoutItems()
    {
        return $this->hasMany(CheckoutItem::class);
    }

}
