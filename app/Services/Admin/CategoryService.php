<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Models\AdminsRole;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Log;


class CategoryService
{
    public function categories()
    {
        $categories = Category::with('parentcategory')->get();
        $admin = Auth::guard('admin')->user();
        $status = "success";
        $message = "";
        $categoriesModule = [];

        // Admin has full access
        if ($admin->role == "admin") {
            $categoriesModule = [
                'view_access' => 1,
                'edit_access' => 1,
                'full_access' => 1
            ];
        } else {
            $categoriesModuleCount = AdminsRole::where([
                'subadmin_id' => $admin->id,
                'module' => 'categories'
            ])->count();

            if ($categoriesModuleCount == 0) {
                $status = "error";
                $message = "This feature is restricted for you!";
            } else {
                $categoriesModule = AdminsRole::where([
                    'subadmin_id' => $admin->id,
                    'module' => 'categories'
                ])->first()->toArray(); // added toArray()
            }
        }
        return [
            'categories' => $categories,
            'status' => $status,
            'message' => $message,
            'categoriesModule' => $categoriesModule
        ];
    }

    public function addEditCategory($request)
    {
        $data = $request->all();
        if (isset($data['id']) && $data['id'] != "") {
            // Edit Category
            $category = Category::find($data['id']);
            $message = "Category updated successfully!";
        } else {
            // Add Category
            $category = new Category;
            $message = "Category added successfully!";
        }

        // Upload Category Image
        if ($request->hasFile('category_image')) {
            $image_tmp = $request->file('category_image');
            if ($image_tmp->isValid()) {
                $manager = new ImageManager(new Driver()); // Corrected: instantiation
                $image = $manager->read($image_tmp);

                $extension = $image_tmp->getClientOriginalExtension();
                $imageName = rand(111, 99999) . '.' . $extension; // Added dot for extension
                $image_path = 'front/images/categories/'; // Corrected path
                $image->save($image_path . $imageName); // Corrected save path
                $category->image = $imageName; // Assuming $category is an object
            }
        }

        // Upload Size Chart
        if ($request->hasFile('size_chart')) {
            $sizechart_tmp = $request->file('size_chart');
            if ($sizechart_tmp->isValid()) {
                $manager = new ImageManager(new Driver()); // Corrected: instantiation
                $image = $manager->read($sizechart_tmp); // Reuse $image variable

                $sizechart_extension = $sizechart_tmp->getClientOriginalExtension();
                $sizechartimageName = rand(111, 99999) . '.' . $sizechart_extension; // Added dot
                $sizechart_image_path = 'front/images/sizecharts/'; // Corrected path
                $image->save($sizechart_image_path . $sizechartimageName); // Corrected save path
                $category->size_chart = $sizechartimageName; //Assumed $category is an object
            }
        }

        // Format name and URL
        $data['category_name'] = str_replace(" - ", " ", ucwords(strtolower($data['category_name'])));
        $data['url'] = str_replace(" ", "-", strtolower($data['url']));

        $category->name = $data['category_name'];

        // Discount default
        if (empty($data['category_discount'])) {
            $data['category_discount'] = 0;
        }
        $category->discount = $data['category_discount'];
        $category->description = $data['description'];
        $category->url = $data['url'];
        $category->meta_title = $data['meta_title'];
        $category->meta_description = $data['meta_description'];
        $category->meta_keywords = $data['meta_keywords'];

        // Menu Status
        if (!empty($data['menu_status'])) {
            $category->menu_status = 1;
        } else {
            $category->menu_status = 0;
        }

        // Status default
        $category->status = 1;

        $category->save();

        return $message;
    }


    public function updateCategoryStatus($data) {
    $status = ($data['status'] == "Active") ? 0 : 1;
    Category::where('id', $data['category_id'])->update(['status' => $status]);
    return $status;
    }
    public function deleteCategory($id) 
    {
        Category::where('id', $id)->delete();
        $message = 'Category deleted successfully!';
        return ['message' => $message];
    }

    // Delete Category & Size Chart Image

public function deleteCategoryImage($categoryId) {
    $categoryImage = Category::where('id', $categoryId)->value('image');
    if ($categoryImage) {
        $category_Image_Path = 'front/images/categories/' . $categoryImage; // Updated path
        if (file_exists(public_path($category_Image_Path))) {
            unlink(public_path($category_Image_Path));
        }
        Category::where('id', $categoryId)->update(['image' => null]);
        return ['status' => true, 'message' => 'Category image deleted successfully!'];
    }
    return ['status' => false, 'message' => 'Category image not found!'];
}



public function deleteSizechartImage($categoryId) {
    $sizechartImage = Category::where('id', $categoryId)->value('size_chart');
    if ($sizechartImage) {
        $sizechartImagePath = 'front/images/sizecharts/' . $sizechartImage; // Updated path
        if (file_exists(public_path($sizechartImagePath))) {
            unlink(public_path($sizechartImagePath));
        }
        Category::where('id', $categoryId)->update(['size_chart' => null]);
        return ['status' => true, 'message' => 'Size Chart image deleted successfully!'];
    }
    return ['status' => false, 'message' => 'Size Chart image not found!'];
}



}
