@extends('admin.layouts.admin')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <h1>{{ $client->name }}'s Information</h1>
                    <p>Email: {{ $client->email }}</p>
                    <hr>

                    <form method="POST" action="{{ route('client.update', $client->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $client->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" value="{{ $client->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value="{{ old('vendor_id') }}">-- Select a Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="vendor">Vendor:</label>
                            <select name="vendor_id" id="vendor_id" class="form-control">
                                <option value="{{ old('vendor_id') }}">-- Select a vendor --</option>
                                @foreach($vendors as $vendor)
                                    <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-warning"
                                onclick="window.location='{{ route('vendor.index') }}'">Cancel
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
        <!-- partial -->
    </div>
@endsection
