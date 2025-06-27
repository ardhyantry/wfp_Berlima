<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'subtotal',
        'discount',
        'total',
        'order_type',
        'payment_type',
        'status',
        'users_id'
    ];

   public function orders()
    {
        return $this->hasMany(Order::class, 'transactions_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
