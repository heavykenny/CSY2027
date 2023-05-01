@extends('admin.layouts.admin')

@section('title', 'All Vendors')

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <h1>All Vendors</h1>
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->name }}</td>
                            <td>{{ $vendor->email }}</td>
                            <td>{{ $vendor->phone }}</td>
                            <td>
                                <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-primary">View</a>
                                <a href="{{ route('vendor.destroy', $vendor->id) }}"
                                   class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="form-group">
                    <a href="{{ route('vendor.create') }}" class="btn btn-success">Add Vendor</a>
                </div>
            </div>

        </div>
    </div>
@endsection
