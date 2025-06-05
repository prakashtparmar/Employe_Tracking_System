<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Use the HasFactory trait if you plan to use model factories for testing or seeding
    use HasFactory;

    /**
     * Retrieves categories based on a specified type.
     * This static method allows calling directly on the model (e.g., Category::getCategories()).
     *
     * @param string|null $type Optional type to filter categories (e.g., 'admin').
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getCategories($type = null)
    {
        // Example logic: if type is 'admin', you might want to fetch all categories.
        // For public-facing sections, you might add a ->where('status', 1) filter here.
        if ($type == 'admin') {
            return self::all(); // Fetches all categories
        }

        // Default behavior: return all categories if no specific type is requested.
        return self::all();
    }

    /**
     * Defines a one-to-one relationship where a category can have one parent category.
     * Assumes a 'parent_id' column in the 'categories' table references the 'id' of another category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function parentcategory()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id')
                    // Select specific columns to avoid fetching unnecessary data
                    ->select('id', 'name', 'url')
                    // Only retrieve parent categories with a 'status' of '1'
                    ->where('status', '1')
                    // Order results by 'id' in ascending order
                    ->orderBy('id', 'ASC');
    }

    // You can add more relationships, accessors, mutators, or other methods here.
}
