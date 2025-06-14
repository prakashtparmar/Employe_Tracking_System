@extends('admin.layout.layout')

@section('content')
<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Trip Management</h3>
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

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <!-- Make form full-width -->
                <div class="col-12">
                    <div class="card card-primary card-outline mb-4">

                        <div class="card-header">
                            <div class="card-title">{{ $title }}</div>
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

                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
                                <strong>Error!</strong> {!! $error !!}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endforeach

                        <form name="tripForm" id="tripForm"
                                action="{{ isset($trip) ? route('trips.update', $trip->id) : route('trips.store') }}"
                                method="post" > {{-- Added enctype for file uploads --}}
                            
                            @csrf
                            <div class="card-body row">
                                <div class="col-md-4 mb-3">
                                    <label for="user_id" class="form-label">User ID</label>
                                    <input type="text" name="user_id" id="user_id" class="form-control" value="{{ Auth::guard('admin')->user()->id }}">
                                </div>

                                

                                <div class="col-md-4 mb-3">
                                    <label for="trip_date" class="form-label">Trip Date</label>
                                    <input type="date" name="trip_date" id="trip_date" class="form-control" >
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="start_time" class="form-label">Start Time</label>
                                    <input type="datetime-local" name="start_time" id="start_time" class="form-control" >
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="end_time" class="form-label">End Time</label>
                                    <input type="datetime-local" name="end_time" id="end_time" class="form-control" >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="start_lat" class="form-label">Start Latitude</label>
                                    <input type="text" name="start_lat" id="start_lat" class="form-control" >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="start_lng" class="form-label">Start Longitude</label>
                                    <input type="text" name="start_lng" id="start_lng" class="form-control" >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="end_lat" class="form-label">End Latitude</label>
                                    <input type="text" name="end_lat" id="end_lat" class="form-control" >
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="end_lng" class="form-label">End Longitude</label>
                                    <input type="text" name="end_lng" id="end_lng" class="form-control" >
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="total_distance_km" class="form-label">Total Distance (KM)</label>
                                    <input type="number" step="0.01" name="total_distance_km" id="total_distance_km"
                                        class="form-control" >
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="travel_mode" class="form-label">Travel Mode</label>
                                    <select name="travel_mode" id="travel_mode" class="form-control">
                                        <option value="car">Car</option>
                                        <option value="bike">Bike</option>
                                        <option value="walk">Walk</option>
                                        <option value="public">Public Transport</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="purpose" class="form-label">Purpose</label>
                                    <input type="text" name="purpose" id="purpose" class="form-control" value="Routine field visit">
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="completed">Completed</option>
                                        <option value="pending">Pending</option>
                                        <option value="cancelled">Cancelled</option>
                                    </select>
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
