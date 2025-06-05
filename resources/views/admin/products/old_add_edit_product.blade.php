@extends('admin.layout.layout')

@section('content')
    <main class="app-main">

        {{-- Page Header --}}
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
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
                    {{-- Changed to col-md-12 for full width --}}
                    <div class="col-md-12">
                        <div class="card card-primary card-outline mb-4">

                            {{-- Card Header --}}
                            <div class="card-header">
                                <h3 class="card-title">{{ $title }}</h3>
                            </div>

                            {{-- Flash Messages --}}
                            @if (Session::has('error_message'))
                                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                    <strong>Error:</strong> {{ Session::get('error_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (Session::has('success_message'))
                                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                    <strong>Success:</strong> {{ Session::get('success_message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                    <strong>Error!</strong> Please correct the following issues:
                                    <ul class="mb-0"> {{-- Added mb-0 to remove bottom margin from ul --}}
                                        @foreach ($errors->all() as $error)
                                            <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            {{-- Product Form --}}
                            <form name="productForm" id="productForm"
                                action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                @if (isset($product))
                                    @method('PUT')
                                @endif
                                <div class="card-body">

                                    {{-- Product Basic Details Section --}}
                                    <h5 class="mb-3 text-primary">Product Basic Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category Level (Select Category) *</label>
                                                <select name="category_id" class="form-control">
                                                    <option value="">-Select-</option>
                                                    @foreach ($getCategories as $cat)
                                                        <option value="{{ $cat['id'] }}"
                                                            @if (old('category_id', $product->category_id ?? '') == $cat['id']) selected @endif>{{ $cat['name'] }}
                                                        </option>
                                                        @if (!empty($cat['subcategories']))
                                                            @foreach ($cat['subcategories'] as $subcat)
                                                                <option value="{{ $subcat['id'] }}"
                                                                    @if (old('category_id', $product->category_id ?? '') == $subcat['id']) selected @endif>
                                                                    &nbsp;&nbsp;&raquo; {{ $subcat['name'] }}</option>
                                                                @if (!empty($subcat['subcategories']))
                                                                    @foreach ($subcat['subcategories'] as $subsubcat)
                                                                        <option value="{{ $subsubcat['id'] }}"
                                                                            @if (old('category_id', $product->category_id ?? '') == $subsubcat['id']) selected @endif>
                                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&raquo;
                                                                            {{ $subsubcat['name'] }}</option>
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="product_name">Product Name*</label>
                                                <input type="text" class="form-control" id="product_name" name="product_name"
                                                    value="{{ old('product_name', $product->product_name ?? '') }}"
                                                    placeholder="Enter Product Name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="product_code">Product Code*</label>
                                                <input type="text" class="form-control" id="product_code" name="product_code"
                                                    value="{{ old('product_code', $product->product_code ?? '') }}"
                                                    placeholder="Enter Product Code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="product_color">Product Color</label>
                                                <input type="text" name="product_color" class="form-control"
                                                    value="{{ old('product_color', $product->product_color ?? '') }}"
                                                    placeholder="Enter Product Color">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php $familyColors = \App\Models\Color::colors(); ?>
                                            <div class="mb-3">
                                                <label class="form-label" for="family_color">Family Color</label>
                                                <select name="family_color" class="form-control">
                                                    <option value="">Please Select</option>
                                                    @foreach ($familyColors as $color)
                                                        <option value="{{ $color->name }}"
                                                            @if (isset($product['family_color']) && $product['family_color'] == $color->name) selected @endif>
                                                            {{ $color->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="group_code">Group Code</label>
                                                <input type="text" name="group_code" class="form-control"
                                                    value="{{ old('group_code', $product->group_code ?? '') }}"
                                                    placeholder="Enter Group Code">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="product_price">Product Price*</label>
                                                <input type="text" class="form-control" id="product_price" name="product_price"
                                                    value="{{ old('product_price', $product->product_price ?? '') }}"
                                                    placeholder="Enter Product Price">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="product_discount">Product Discount (%)</label>
                                                <input type="number" step="0.01" name="product_discount"
                                                    class="form-control"
                                                    value="{{ old('product_discount', $product->product_discount ?? '') }}" placeholder="e.g., 10.50">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="product_gst">Product GST (%)</label>
                                                <input type="number" step="0.01" name="product_gst" class="form-control"
                                                    value="{{ old('product_gst', $product->product_gst ?? '') }}" placeholder="e.g., 18.00">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="product_weight">Product Weight (Kg)</label>
                                        <input type="number" step="0.01" name="product_weight" class="form-control"
                                            value="{{ old('product_weight', $product->product_weight ?? '') }}" placeholder="e.g., 0.50">
                                    </div>

                                    <hr class="my-4"> {{-- Separator for media uploads --}}
                                    <h5 class="mb-3 text-primary">Product Media</h5>

                                    <div class="mb-3">
                                        <label class="form-label" for="mainImageDropzone">Product Main Image (Max 500 KB)</label>
                                        <div class="dropzone border p-3 rounded" id="mainImageDropzone"></div>
                                        <small class="form-text text-muted">Drag & drop main image here, or click to upload.</small>
                                        @if (!empty($product['main_image']))
                                            <div class="mt-3 p-2 border rounded d-inline-block align-items-center">
                                                <a target="_blank"
                                                    href="{{ url('front/images/products/' . $product['main_image']) }}">
                                                    <img style="width:120px; height:auto; object-fit: contain; margin-right: 15px;"
                                                        src="{{ asset('front/images/products/' . $product['main_image']) }}" class="img-thumbnail">
                                                </a>
                                                <a style="color:#dc3545; vertical-align: middle;" class="confirmDelete btn btn-sm btn-outline-danger" title="Delete Product Image"
                                                    href="javascript:void(0)" data-module="product-main-image"
                                                    data-id="{{ $product['id'] }}">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete Main Image
                                                </a>
                                            </div>
                                        @endif
                                        <input type="hidden" name="main_image" id="main_image_hidden">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="productImagesDropzone">Alternate Product Images (Multiple Uploads Allowed, Max 500 KB each)</label>
                                        <div class="dropzone border p-3 rounded" id="productImagesDropzone"></div>
                                        <small class="form-text text-muted">Drag & drop multiple alternate images here, or click to upload.</small>
                                        <div class="mt-3 d-flex flex-wrap gap-2"> {{-- Flexbox for better image display --}}
                                            @if (isset($product->product_images) && $product->product_images->count() > 0)
                                                @foreach ($product->product_images as $img)
                                                    <div class="p-2 border rounded position-relative">
                                                        <a target="_blank"
                                                            href="{{ url('front/images/products/' . $img->image) }}">
                                                            <img style="width:100px; height:auto; object-fit: contain;" src="{{ asset('front/images/products/' . $img->image) }}" class="img-thumbnail" />
                                                        </a>
                                                        <a style="position:absolute; top:-8px; right:-8px; color:#dc3545; font-size:1.5rem; text-decoration:none;" class="confirmDelete" title="Delete Product Image"
                                                            href="javascript:void(0)" data-module="product-image"
                                                            data-id="{{ $img->id }}">
                                                            <i class="fas fa-times-circle"></i>
                                                        </a>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        <input type="hidden" name="product_images" id="product_images_hidden">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="productVideoDropzone">Product Video (Max 2 MB)</label>
                                        <div class="dropzone border p-3 rounded" id="productVideoDropzone"></div>
                                        <small class="form-text text-muted">Drag & drop a product video here, or click to upload.</small>
                                        @if (!empty($product['product_video']))
                                            <div class="mt-3 p-2 border rounded d-inline-flex align-items-center">
                                                <span class="me-3">Product Video:</span>
                                                <a target="_blank"
                                                    href="{{ url('front/videos/products/' . $product['product_video']) }}" class="btn btn-sm btn-info me-2">
                                                    <i class="fas fa-play-circle me-1"></i> View Video
                                                </a>
                                                <a href="javascript:void(0)" class="confirmDelete btn btn-sm btn-danger" data-module="product-video"
                                                    data-id="{{ $product['id'] }}">
                                                    <i class="fas fa-trash-alt me-1"></i> Delete Video
                                                </a>
                                            </div>
                                        @endif
                                        <input type="hidden" name="product_video" id="product_video_hidden">
                                    </div>

                                    <hr class="my-4"> {{-- Separator for descriptions --}}
                                    <h5 class="mb-3 text-primary">Descriptions & Keywords</h5>

                                    <div class="mb-3">
                                        <label class="form-label" for="wash_care">Wash Care</label>
                                        <textarea name="wash_care" class="form-control" rows="3" placeholder="Enter Wash Care instructions">{{ old('wash_care', $product->wash_care ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="description">Product Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5"
                                            placeholder="Provide a detailed product description">{{ old('description', $product->description ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="search_keywords">Search Keywords</label>
                                        <textarea name="search_keywords" class="form-control" rows="3" placeholder="Enter comma-separated search keywords (e.g., shirt, t-shirt, casual, summer)">{{ old('search_keywords', $product->search_keywords ?? '') }}</textarea>
                                    </div>

                                    <hr class="my-4"> {{-- Separator for SEO fields --}}
                                    <h5 class="mb-3 text-primary">SEO Information</h5>

                                    <div class="mb-3">
                                        <label class="form-label" for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ old('meta_title', $product->meta_title ?? '') }}" placeholder="Enter SEO friendly meta title">
                                        <small class="form-text text-muted">Recommended length: 50-60 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Enter SEO friendly meta description">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                                        <small class="form-text text-muted">Recommended length: 150-160 characters</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" rows="3" placeholder="Enter comma-separated meta keywords for search engines">{{ old('meta_keywords', $product->meta_keywords ?? '') }}</textarea>
                                    </div>

                                    <hr class="my-4"> {{-- Separator for status --}}
                                    <h5 class="mb-3 text-primary">Product Status</h5>

                                    <div class="mb-3">
                                        <label class="form-label" for="is_featured">Is Featured?</label>
                                        <select name="is_featured" class="form-select">
                                            <option value="No"
                                                {{ old('is_featured', $product->is_featured ?? '') == 'No' ? 'selected' : '' }}>
                                                No</option>
                                            <option value="Yes"
                                                {{ old('is_featured', $product->is_featured ?? '') == 'Yes' ? 'selected' : '' }}>
                                                Yes</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-footer text-end"> {{-- Align button to the right --}}
                                    <button type="submit" class="btn btn-primary btn-lg"> {{-- Make button slightly larger --}}
                                        <i class="fas fa-save me-2"></i> Submit Product
                                    </button>
                                </div>
                            </form>
                            {{-- End Form --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection