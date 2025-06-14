@extends('admin.layout.layout')
@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Trip</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Admin Management</a></li>
                            <li class="breadcrumb-item active">Trip</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Trip Details</h3>
                                <a style="max-width: 150px; float:right; display: inline-block;"
                                    href="{{ url('admin/trips/create') }}" class="btn btn-block btn-primary">
                                    Add New Trip
                                </a>
                            </div>
                            <div class="card-body">
                                @if (Session::has('success_message'))
                                    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                                        <strong>Success: </strong> {{ Session::get('success_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                @if (Session::has('error_message'))
                                    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                        <strong>Error: </strong> {{ Session::get('error_message') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="table-responsive">
                                    <table id="trips" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="align-middle">
                                                <th>ID</th>
                                                <th>User ID</th>
                                                <th>Trip Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>Start Lat</th>
                                                <th>Start Lng</th>
                                                <th>End Lat</th>
                                                <th>End Lng</th>
                                                <th>Total Distance (km)</th>
                                                <th>Travel Mode</th>
                                                <th>Purpose</th>
                                                <th>Status</th>
                                                <th>Approve/Deny Status</th>
                                                <th>Approve/Deny Reason</th>
                                                <th>Processed By</th>
                                                <th>Processed At</th>
                                                <th>Created At</th>
                                                <th>Updated At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($trips as $trip)
                                                <tr class="align-middle">
                                                    <td>{{ $trip->id }}</td>
                                                    <td>{{ $trip->user_id }}</td>
                                                    <td>{{ $trip->trip_date }}</td>
                                                    <td>{{ $trip->start_time }}</td>
                                                    <td>{{ $trip->end_time }}</td>
                                                    <td>{{ $trip->start_lat }}</td>
                                                    <td>{{ $trip->start_lng }}</td>
                                                    <td>{{ $trip->end_lat }}</td>
                                                    <td>{{ $trip->end_lng }}</td>
                                                    <td>{{ $trip->total_distance_km }}</td>
                                                    <td>{{ $trip->travel_mode }}</td>
                                                    <td>{{ $trip->purpose }}</td>
                                                    <td>{{ ucfirst($trip->status) }}</td>
                                                    <td>{{ ucfirst($trip->approval_status) }}</td>
                                                    <td>{{ $trip->approval_reason }}</td>
                                                    <td>{{ $trip->approved_by }}</td>
                                                    <td>{{ $trip->approved_at }}</td>
                                                    <td>{{ $trip->created_at }}</td>
                                                    <td>{{ $trip->updated_at }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <button class="btn btn-sm btn-primary dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Actions
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('admin/trip/' . $trip->id) }}">Show
                                                                        Trip
                                                                        Details</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item"
                                                                        href="{{ url('admin/add-edit-trip/' . $trip->id) }}">Edit
                                                                        Trip</a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item text-success"
                                                                        href="{{ url('admin/trips/approve/' . $trip->id) }}">Approve
                                                                        Trip</a>
                                                                </li>

                                                                <li> 
                                                                    <a href="javascript:void(0);"
                                                                        class="dropdown-item text-warning"
                                                                        onclick="openRejectModal({{ $trip->id }})">
                                                                        Deny Trip
                                                                    </a>
                                                                </li>


                                                                <li>
                                                                    <form action="{{ url('admin/trips/' . $trip->id) }}"
                                                                        method="POST"
                                                                        onsubmit="return confirm('Are you sure you want to delete this trip?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="dropdown-item text-danger">Delete
                                                                            Trip</button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


<!-- Deny Trip Modal -->
<div class="modal fade" id="denyTripModal" tabindex="-1" role="dialog" aria-labelledby="denyTripModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="denyTripForm">
      @csrf
      <input type="hidden" name="trip_id" id="denyTripId">

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Deny Trip</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="reason">Reason for Denial</label>
            <textarea name="reason" class="form-control" required maxlength="255"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Deny</button>
        </div>
      </div>
    </form>
  </div>
</div>
