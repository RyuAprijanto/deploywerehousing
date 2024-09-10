<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'transaction_type_id', 'date', 'price', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }
}
