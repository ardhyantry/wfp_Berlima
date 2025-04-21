<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactions_id',
        'menus_id',
        'portion_size',
        'quantity',
        'total',
        'notes'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactions_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menus_id');
    }
}
