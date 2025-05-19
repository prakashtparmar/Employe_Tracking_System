@extends('admin.layout.layout')

@section('content')

<main class="app-main">

  {{-- Page Header --}}
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Categories Management</h3>
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
        <div class="col-md-6">
          <div class="card card-primary card-outline mb-4">

            {{-- Card Header --}}
            <div class="card-header">
              <div class="card-title">Add Cetegory</div>
            </div>

            {{-- Flash Messages --}}
            @if(Session::has('error_message'))
              <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <strong>Error:</strong> {{ Session::get('error_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                <strong>Success:</strong> {{ Session::get('success_message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            {{-- Validation Errors --}}
            @foreach($errors->all() as $error)
              <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                <strong>Error!</strong> {!! $error !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endforeach

            {{-- Update Form --}}
            <form name="categoryForm" id="categoryForm" action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    @if(isset($category))
        @method('PUT')
    @endif

    <div class="card-body">
        <div class="mb-3">
            <label class="form-label" for="category_name">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter Category Name" value="{{ old('category_name', $category->name ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="product_category">Product Category</label>
            <select class="form-select" id="product_category" name="product_category">
                <option value="">Select a Category</option>
                <option value="1">Clothing</option>
                <option value="2">Electronics</option>
                <option value="3">Appliances</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label" for="category_image">Category Image</label>
            <input type="file" class="form-control" id="category_image" name="category_image">
            @if(!empty($category->image))
                <div class="mt-2" id="categoryImageBlock">
                    <a target="_blank" href="{{ url('front/images/categories/' . $category->image) }}">
                        {{-- Display the image --}}
                    <img src="{{ asset('front/images/categories/'.$category->image) }}" width="50" alt="Category Image">
                    
                    </a>
                    <a href="javascript:void(0);" id="deleteCategoryImage" data-category-id="{{ $category->id }}" class="text-danger">Delete</a>
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label" for="size_chart">Size Chart</label>
            <input type="file" class="form-control" id="size_chart" name="size_chart" accept="image/*">
            @if(!empty($category->size_chart))
                <div class="mt-2" id="sizechartImageBlock">
                    <a target="_blank" href="{{ url('front/images/sizecharts/' . $category->size_chart) }}">
                        {{-- Display the image --}}
                    <img src="{{ asset('front/images/sizecharts/'.$category->size_chart) }}" width="50" alt="Size Chart">
                    
                    </a>
                    <a href="javascript:void(0);" id="deleteSizeChartImage" data-category-id="{{ $category->id }}" class="text-danger">Delete</a>
                </div>
            @endif
        </div>
        
         <div class="mb-3">
            <label class="form-label" for="category_discount">Category Discount</label>
            <input type="text" class="form-control" id="category_discount" placeholder="Enter Category Discount" name="category_discount" value="{{ old('category_discount', $category->discount ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="url">Category URL*</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Enter Category URL" value="{{ old('url', $category->url ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Category Description*</label>
            <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter Description">{{ old('description', $category->description ?? '') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label" for="meta_title">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Meta Title" value="{{ old('meta_title', $category->meta_title ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="meta_description">Meta Description</label>
            <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Meta Description" value="{{ old('meta_description', $category->meta_description ?? '') }}">
        </div>
        <div class="mb-3">
            <label class="form-label" for="meta_keywords">Meta Keywords</label>
            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}">
        </div>
        <div class="mb-3">
            <label for="menu status">Show on Header Menu</label><br>
            <input type="checkbox" name="menu_status" value="1" {{ !empty($category->menu_status) ? 'checked' : '' }}>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>


          </div>
        </div>
      </div>
    </div>
  </div>

</main>

@endsection
