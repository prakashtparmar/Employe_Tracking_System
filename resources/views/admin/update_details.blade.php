@extends('admin.layout.layout')

@section('content')

<main class="app-main">

  {{-- Page Header --}}
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Admin Management</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Update Details Form</li>
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
              <div class="card-title">Update Details</div>
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
            <form method="POST" action="{{ route('admin.update-details.request') }}" enctype="multipart/form-data" >
              @csrf
              <div class="card-body">

                {{-- Email Field (Readonly) --}}
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input
                    type="email"
                    class="form-control"
                    id="email"
                    value="{{ Auth::guard('admin')->user()->email }}"
                    readonly
                    style="background-color: #ccc;" />
                </div>

                {{-- Name --}}
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    value="{{ Auth::guard('admin')->user()->name }}" />
                </div>

                {{-- Mobile --}}
                <div class="mb-3">
                  <label for="mobile" class="form-label">Mobile</label>
                  <input
                    type="text"
                    class="form-control"
                    id="mobile"
                    name="mobile"
                    value="{{ Auth::guard('admin')->user()->mobile }}" />
                </div>

                {{-- Image Upload --}}
              <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input
                      type="file"
                      class="form-control"
                      id="image"
                      name="image"
                      accept="image/*"
                  />

                  @if(!empty(Auth::guard('admin')->user()->image))
                      <div id="profileImageBlock" class="mt-2">
                          <a target="_blank" href="{{ url('admin/images/photos/' . Auth::guard('admin')->user()->image) }}">
                              View
                          </a> |
                          <input
                              type="hidden"
                              name="current_image"
                              value="{{ Auth::guard('admin')->user()->image }}"
                          />
                          <a
                              href="javascript:void(0);"
                              id="deleteProfileImage"
                              data-admin-id="{{ Auth::guard('admin')->user()->id }}"
                              class="text-danger"
                          >
                              Delete
                          </a>
                      </div>
                  @endif
              </div>


              </div> {{-- End card-body --}}

              {{-- Submit Button --}}
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
