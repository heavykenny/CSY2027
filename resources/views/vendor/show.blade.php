@extends('admin.layouts.admin')

@section('title', 'Vendor Information')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="col-sm-12">

                    <h1>{{ $vendor->name }}'s Information</h1>
                    <p>Email: {{ $vendor->email }}</p>

                    <hr>

                    <form method="POST" action="{{ route('vendor.update', $vendor->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $vendor->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" name="email" value="{{ $vendor->email }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" name="phone" value="{{ $vendor->phone }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" class="form-control" name="address" value="{{ $vendor->address }}"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-warning"
                                onclick="window.location='{{ route('vendor.index') }}'">Cancel
                        </button>
                    </form>
                </div>


            </div>

        </div>
    </div>
@endsection
