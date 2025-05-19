<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        // Corrected relationship definition
        return $this->belongsTo(Category::class, 'category_id')
                    ->with('parentCategory'); // Corrected method name to 'parentCategory'
    }
}

