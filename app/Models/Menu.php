<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'nutrition_fact',
        'price',
        'stock',
        'image_path',
        'categories_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 
        'menus_has_ingredients', 'menus_id',
         'ingredients_id');
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,'orders',
        'menus_id', 'transactions_id');
    }
}