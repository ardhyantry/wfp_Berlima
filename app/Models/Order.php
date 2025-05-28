<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'transactions_id',
        'menus_id',
        'portion_size',
        'quantity',
        'total',
        'notes',
    ];

    // Relasi ke Transaction
    public function transaction()
    {
        return $this->belongsToMany(Transaction::class, 'transactions_id');
    }

    // Relasi ke Menu
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'orders', 'menus_id', 'transactions_id');
    }
}
