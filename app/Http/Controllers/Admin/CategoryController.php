<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Admin\CategoryService;
use App\Models\Category;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Facades\Log;

use Session;


class CategoryController extends Controller
{
    protected $categoryService;
    
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Session::put('page', 'categories');
        $result = $this->categoryService->categories();

        if ($result['status'] === 'error') {
            return redirect('admin/dashboard')->with('error_message', $result['message']);
        }

        return view('admin.categories.index', [
            'categories' => $result['categories'],
            'categoriesModule' => $result['categoriesModule']
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Add Category';
        return view('admin.categories.add_edit_category', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $message = $this->categoryService->addEditCategory($request);
        return redirect()->route('categories.index')->with('success_message', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Edit Category';
        $category = Category::findOrFail($id);
        return view('admin.categories.add_edit_category', compact('title', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $request->merge(['id' => $id]);
        $message = $this->categoryService->addEditCategory($request);
        return redirect()->route('categories.index')->with('success_message', $message);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->categoryService->deleteCategory($id);
        return redirect()->back()->with('success_message', $result['message']);
    }

    public function updateCategoryStatus(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            $status = $this->categoryService->updateCategoryStatus($data);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function deleteCategoryImage(Request $request){

        $status = $this->categoryService->deleteCategoryImage($request->category_id);
        return response()->json($status);
    }


    public function deleteSizechartImage(Request $request){

        $status = $this->categoryService->deleteSizechartImage($request->category_id);
        return response()->json($status);
    }


}
