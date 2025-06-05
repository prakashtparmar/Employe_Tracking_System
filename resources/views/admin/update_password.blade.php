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
            <li class="breadcrumb-item active">Password Reset Form</li>
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
              <div class="card-title">Update Password</div>
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

            {{-- Password Update Form --}}
            <form method="POST" action="{{ route('admin.update-password.request') }}">
              @csrf
              <div class="card-body">

                {{-- Email Field (Readonly) --}}
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email address</label>
                  <input
                    type="email"
                    class="form-control"
                    id="exampleInputEmail1"
                    value="{{ Auth::guard('admin')->user()->email }}"
                    readonly />
                </div>

                {{-- Current Password --}}
                <div class="mb-3">
                  <label for="current_pwd" class="form-label">Current Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="current_pwd"
                    name="current_pwd"
                    required
                  />
                  <span id="verifyPwd"></span> {{-- Placeholder for JS-based verification --}}
                </div>

                {{-- New Password --}}
                <div class="mb-3">
                  <label for="new_pwd" class="form-label">New Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="new_pwd"
                    name="new_pwd"
                    required
                  />
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                  <label for="confirm_pwd" class="form-label">Confirm Password</label>
                  <input
                    type="password"
                    class="form-control"
                    id="confirm_pwd"
                    name="confirm_pwd"
                    required
                  />
                </div>
              </div>

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
