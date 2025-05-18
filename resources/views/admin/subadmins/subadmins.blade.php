@extends('admin.layout.layout')

@section('content')

<!-- App Main Section -->
<main class="app-main">

  <!-- Page Header -->
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0">Sub Admins</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Admin Management</a></li>
            <li class="breadcrumb-item active">Sub Admins</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <!-- End Page Header -->

  <!-- Page Content -->
  <div class="app-content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

          <!-- Bordered Table Card -->
          <div class="card mb-4">
            <div class="card-header">
              <h3 class="card-title">Bordered Table</h3>
              <a style="max-width: 150px; float:right; display: inline-block;"
                href="{{ url('admin/add-edit-subadmin') }}"
                class="btn btn-block btn-primary">
                  Add Sub Admin
              </a>
            </div>

            <div class="card-body">
              @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                      <strong>Success: </strong> {{ Session::get('success_message') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              @endif
              <table id="subadmins" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($subadmins as $subadmin)
                    <tr class="align-middle">
                      <td>{{ $subadmin->id }}</td>
                      <td>{{ $subadmin->name }}</td>
                      <td>{{ $subadmin->mobile }}</td>
                      <td>{{ $subadmin->email }}</td>
                      <td>
                        @if($subadmin->status == 1)
                            <a class="updateSubadminStatus" data-subadmin_id="{{ $subadmin->id }}"
                            style="color:#3f6ed3" href="javascript:void(0)"><i class="fas fa-toggle-on" data-status="Active"></i></a>
                        @else
                            <a class="updateSubadminStatus" data-subadmin_id="{{ $subadmin->id }}"
                            style="color:grey" href="javascript:void(0)"><i class="fas fa-toggle-off" data-status="Inactive"></i></a>
                        @endif

                        &nbsp;&nbsp;
                        <a style="color:#3f6ed3;" title="Edit Subadmin"
                          href="{{ url('admin/add-edit-subadmin/' . $subadmin->id) }}" ><i class="fas fa-edit"></i></a>
                        
                        &nbsp;&nbsp;
                        <a title="Set Permissions for Sub-admin" href="{{ url('admin/update-role/' . $subadmin->id) }}">
                          <i class="fas fa-unlock"></i></a>

                        &nbsp;&nbsp;
                        <a class="confirmDelete" name="Subadmin" style="color:#3f6ed3;" title="Delete Subadmin" data-module="subadmin" data-id="{{$subadmin->id}}" <?php /**
                          href="{{ url('admin/delete-subadmin/' . $subadmin->id) }}" */ ?>><i class="fas fa-trash"></i></a>

                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <!-- End Bordered Table Card -->

        </div>
      </div>
    </div>
  </div>
  <!-- End Page Content -->

</main>
<!-- End App Main Section -->

@endsection
