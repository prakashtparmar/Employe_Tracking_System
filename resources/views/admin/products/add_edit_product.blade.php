@extends('admin.layout.layout')

@section('content')

<main class="app-main">

    {{-- Page Header --}}
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Product Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus me-2"></i> Add New Product Details</h6>
                        </div>
                        <div class="card-body">
                            {{-- Flash Messages --}}
                            @if(Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                                    <strong>Error:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if(Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Validation Errors --}}
                            @if($errors->any())
                                <div class="alert alert-danger mb-3">
                                    <ul class="list-unstyled mb-0">
                                        @foreach($errors->all() as $error)
                                            <li><i class="fas fa-exclamation-circle me-2"></i> {{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            <form name="categoryForm" id="categoryForm" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @if(isset($category))
                                    @method('PUT')
                                @endif

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="product_name"><i class="fas fa-tag me-2"></i>Product Name</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" value="{{ old('product_name', $product->product_name ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="category_id"><i class="fas fa-folder-open me-2"></i> Select Category Type </label>
                                        <select class="form-select" id="category_id" name="category_id">
                                            <option value="">Select Category ID</option>
                                            <option value="1">Clothing</option>
                                            <option value="2">Electronics</option>
                                            <option value="3">Appliances</option>
                                            <option value="4">Men</option>
                                            <option value="5">Women</option>
                                            <option value="6">Kids</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="product_code"><i class="fas fa-tag me-2"></i>Product Code</label>
                                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Product Code" value="{{ old('product_code', $product->product_code ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="product_color"><i class="fas fa-tag me-2"></i>Product Colour</label>
                                        <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter Product Colour" value="{{ old('product_color', $product->product_color ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="product_price"><i class="fas fa-dollar-sign me-2"></i>Product Price</label>
                                        <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price" value="{{ old('product_price', $product->product_price ?? '') }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="product_discount"><i class="fas fa-percentage me-2"></i>Product Discount %</label>
                                        <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter Product Discount Percentage" value="{{ old('product_discount', $product->product_discount ?? '') }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="product_discount_amount"><i class="fas fa-coins me-2"></i>Product Discount Amount</label>
                                        <input type="text" class="form-control" id="product_discount_amount" name="product_discount_amount" placeholder="Enter Product Discount Amount" value="{{ old('product_discount_amount', $product->product_discount_amount ?? '') }}">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="final_price"><i class="fas fa-money-bill-wave me-2"></i>Product Final Price</label>
                                        <input type="text" class="form-control" id="final_price" name="final_price" placeholder="Enter Product Final Price" value="{{ old('final_price', $product->final_price ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="fabric"><i class="fas fa-tshirt me-2"></i>Fabric</label>
                                        <input type="text" class="form-control" id="fabric" name="fabric" placeholder="e.g., Cotton, Polyester" value="{{ old('fabric', $product->fabric ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="pattern"><i class="fas fa-paint-brush me-2"></i>Pattern</label>
                                        <input type="text" class="form-control" id="pattern" name="pattern" placeholder="e.g., Solid, Striped" value="{{ old('pattern', $product->pattern ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="sleeve"><i class="fas fa-child me-2"></i>Sleeve</label>
                                        <input type="text" class="form-control" id="sleeve" name="sleeve" placeholder="e.g., Full Sleeve, Half Sleeve" value="{{ old('sleeve', $product->sleeve ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="fit"><i class="fas fa-ruler me-2"></i>Fit</label>
                                        <input type="text" class="form-control" id="fit" name="fit" placeholder="e.g., Regular Fit, Slim Fit" value="{{ old('fit', $product->fit ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="occasion"><i class="fas fa-calendar-alt me-2"></i>Occasion</label>
                                        <input type="text" class="form-control" id="occasion" name="occasion" placeholder="e.g., Casual, Formal" value="{{ old('occasion', $product->occasion ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="stock"><i class="fas fa-boxes me-2"></i>Stock</label>
                                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Enter current stock quantity" value="{{ old('stock', $product->stock ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="sort"><i class="fas fa-sort-numeric-up-alt me-2"></i>Sort Order</label>
                                        <input type="number" class="form-control" id="sort" name="sort" placeholder="Enter display sort order" value="{{ old('sort', $product->sort ?? '') }}">
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label" for="meta_title"><i class="fas fa-heading me-2"></i>Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter SEO friendly title" value="{{ old('meta_title', $product->meta_title ?? '') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="meta_description"><i class="fas fa-file-alt me-2"></i>Meta Description</label>
                                        <textarea class="form-control" id="meta_description" name="meta_description" rows="3" placeholder="Enter a brief SEO description">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="meta_keywords"><i class="fas fa-tags me-2"></i>Meta Keywords</label>
                                        <textarea class="form-control" id="meta_keywords" name="meta_keywords" rows="3" placeholder="Enter comma-separated keywords">{{ old('meta_keywords', $product->meta_keywords ?? '') }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="is_featured"><i class="fas fa-star me-2"></i>Is Featured?</label>
                                        <select class="form-select" id="is_featured" name="is_featured">
                                            <option value="No" {{ (old('is_featured', $product->is_featured ?? '') == 'No') ? 'selected' : '' }}>No</option>
                                            <option value="Yes" {{ (old('is_featured', $product->is_featured ?? '') == 'Yes') ? 'selected' : '' }}>Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="main_image"><i class="fas fa-image me-2"></i> Product Image</label>
                                        <input type="file" class="form-control" id="main_image" name="main_image">
                                        @if(!empty($category->image))
                                            <div class="mt-2" id="categoryImageBlock">
                                                <a target="_blank" href="{{ url('front/images/categories/' . $category->image) }}">
                                                    <img src="{{ asset('front/images/categories/'.$category->image) }}" class="img-thumbnail" width="75" alt="Category Image">
                                                </a>
                                                <a href="javascript:void(0);" id="deleteCategoryImage" data-category-id="{{ $category->id }}" class="text-danger ms-2"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="size_chart"><i class="fas fa-ruler me-2"></i> Size Chart</label>
                                        <input type="file" class="form-control" id="size_chart" name="size_chart" accept="image/*">
                                        @if(!empty($category->size_chart))
                                            <div class="mt-2" id="sizechartImageBlock">
                                                <a target="_blank" href="{{ url('front/images/sizecharts/' . $category->size_chart) }}">
                                                    <img src="{{ asset('front/images/sizecharts/'.$category->size_chart) }}" class="img-thumbnail" width="75" alt="Size Chart">
                                                </a>
                                                <a href="javascript:void(0);" id="deleteSizeChartImage" data-category-id="{{ $category->id }}" class="text-danger ms-2"><i class="fas fa-trash-alt"></i> Delete</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="category_discount"><i class="fas fa-percent me-2"></i> Category Discount</label>
                                        <input type="text" class="form-control" id="category_discount" placeholder="Enter Category Discount" name="category_discount" value="{{ old('category_discount', $category->discount ?? '') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label" for="url"><i class="fas fa-link me-2"></i> Category URL <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="url" name="url" placeholder="Enter Category URL" value="{{ old('url', $category->url ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="description"><i class="fas fa-file-alt me-2"></i> Product Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control" rows="4" id="description" name="description" placeholder="Enter Description">{{ old('description', $category->description ?? '') }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="meta_title"><i class="fas fa-heading me-2"></i> Meta Title</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" value="{{ old('meta_title', $category->meta_title ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="meta_description"><i class="fas fa-file-signature me-2"></i> Meta Description</label>
                                        <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description" value="{{ old('meta_description', $category->meta_description ?? '') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="meta_keywords"><i class="fas fa-key me-2"></i> Meta Keywords</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="menu_status" id="menu_status" value="1" {{ !empty($category->menu_status) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="menu_status"><i class="fas fa-bars me-2"></i> Show on Header Menu</label>
                                    </div>
                                </div>

                                <div class="card-footer bg-light py-3">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i> Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@endsection