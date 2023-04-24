@extends('admin.layouts.admin')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <h1>All Clients</h1>
                <div class="col-sm-8">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Vendor</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->role->name }}</td>
                                <td>{{ $client->vendor->name ?? 'No Vendor' }}</td>
                                <td>
                                    <a href="{{ route('client.show', $client->id) }}" class="btn btn-primary">View</a>
                                    <a href="{{ route('client.destroy', $client->id) }}"
                                       class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="form-group">
                        <a href="{{ route('vendor.create') }}" class="btn btn-success">Add Client</a>
                    </div>
                </div>


            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
        <!-- partial -->
    </div>
@endsection
