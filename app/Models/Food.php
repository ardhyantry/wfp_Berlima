<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;


    public function category()
    {
        return $this->BelongsTo(Category::class, 'category_id');
    }
}
