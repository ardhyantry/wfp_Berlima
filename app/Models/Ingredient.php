<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menus_has_ingredients', 'ingredients_id', 'menus_id');
    }
}