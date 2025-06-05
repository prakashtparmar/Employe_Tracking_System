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
                    <div class="col-md-8 offset-md-2"> {{-- Centering the form and making it wider --}}
                        <div class="card card-primary card-outline mb-4">

                            {{-- Card Header --}}
                            <div class="card-header">
                                <div class="card-title">{{ $title }}</div> {{-- Dynamic title for Add/Edit --}}
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
                                    <ul>
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
                                method="post" enctype="multipart/form-data"> {{-- Added enctype for file uploads --}}
                                @csrf
                                @if (isset($product))
                                    @method('PUT')
                                @endif
                                <div class="card-body">
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
                                                    value="{{ old('product_discount', $product->product_discount ?? '') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="product_gst">Product GST (%)</label>
                                                <input type="number" step="0.01" name="product_gst" class="form-control"
                                                    value="{{ old('product_gst', $product->product_gst ?? '') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="product_weight">Product Weight (Kg)</label>
                                        <input type="number" step="0.01" name="product_weight" class="form-control"
                                            value="{{ old('product_weight', $product->product_weight ?? '') }}">
                                    </div>

                                    <hr> {{-- Separator for image uploads --}}

                                    <div class="mb-3">
                                        <label class="form-label" for="mainImageDropzone">Product Main Image (Max 500 KB)</label>
                                        <div class="dropzone" id="mainImageDropzone"></div>
                                        @if (!empty($product['main_image']))
                                            <div class="mt-2">
                                                <a target="_blank"
                                                    href="{{ url('front/images/products/' . $product['main_image']) }}">
                                                    <img style="width:100px; border:1px solid #ddd;"
                                                        src="{{ asset('front/images/products/' . $product['main_image']) }}">
                                                </a>
                                                <a style="color:#dc3545; margin-left: 10px;" class="confirmDelete" title="Delete Product Image"
                                                    href="javascript:void(0)" data-module="product-main-image"
                                                    data-id="{{ $product['id'] }}">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>
                                            </div>
                                        @endif
                                        <input type="hidden" name="main_image" id="main_image_hidden">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="productImagesDropzone">Alternate Product Images (Multiple Uploads Allowed, Max 500 KB each)</label>
                                        <div class="dropzone" id="productImagesDropzone"></div>
                                        <div class="mt-2 d-flex flex-wrap"> {{-- Flexbox for better image display --}}
                                            @if (isset($product->product_images) && $product->product_images->count() > 0)
                                                @foreach ($product->product_images as $img)
                                                    <div style="display:inline-block; position:relative; margin:5px; border:1px solid #ddd; padding:5px;">
                                                        <a target="_blank"
                                                            href="{{ url('front/images/products/' . $img->image) }}">
                                                            <img style="width:80px;" src="{{ asset('front/images/products/' . $img->image) }}" />
                                                        </a>
                                                        <a style="position:absolute; top:-5px; right:-5px; color:#dc3545;" class="confirmDelete" title="Delete Product Image"
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
                                        <div class="dropzone" id="productVideoDropzone"></div>
                                        @if (!empty($product['product_video']))
                                            <div class="mt-2">
                                                <a target="_blank"
                                                    href="{{ url('front/videos/products/' . $product['product_video']) }}" class="btn btn-sm btn-info">View Video</a>
                                                <a href="javascript:void(0)" class="confirmDelete btn btn-sm btn-danger ms-2" data-module="product-video"
                                                    data-id="{{ $product['id'] }}">Delete Video</a>
                                            </div>
                                        @endif
                                        <input type="hidden" name="product_video" id="product_video_hidden">
                                    </div>

                                    <hr> {{-- Separator for textual fields --}}

                                    <div class="mb-3">
                                        <label class="form-label" for="wash_care">Wash Care</label>
                                        <textarea name="wash_care" class="form-control" rows="3" placeholder="Enter Wash Care">{{ old('wash_care', $product->wash_care ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="description">Product Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5"
                                            placeholder="Enter Product Description">{{ old('description', $product->description ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="search_keywords">Search Keywords</label>
                                        <textarea name="search_keywords" class="form-control" rows="3" placeholder="Enter Search Keywords">{{ old('search_keywords', $product->search_keywords ?? '') }}</textarea>
                                    </div>

                                    <hr> {{-- Separator for SEO fields --}}

                                    <div class="mb-3">
                                        <label class="form-label" for="meta_title">Meta Title</label>
                                        <input type="text" name="meta_title" class="form-control"
                                            value="{{ old('meta_title', $product->meta_title ?? '') }}" placeholder="Enter Meta Title">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Enter Meta Description">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" rows="3" placeholder="Enter Meta Keywords">{{ old('meta_keywords', $product->meta_keywords ?? '') }}</textarea>
                                    </div>

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

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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