<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function status()
    {
        return $this->hasOne(OrderStatus::class, 'transactions_id');
    }

    public function details()
    {
        return $this->hasMany(DetailTransaction::class, 'transactions_id');
    }
}