<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'menus_has_ingredients', 'menus_id', 'ingredients_id');
    }

    public function detailTransactions()
    {
        return $this->hasMany(DetailTransaction::class, 'menus_id');
    }
}