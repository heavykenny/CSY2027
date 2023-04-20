@extends('admin.layouts.admin')

@section('title', 'Permission')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-sm-12">
                    <form method="POST" action="{{ route('permission.store') }}">
                        @csrf
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Permissions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->role->name }}</td>
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <td>
                                        @foreach ($permissions as $permission)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                       value="{{ $permission->id }}" {{ $client->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                <label class="form-check-label">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>

            </div>
        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
        <!-- partial -->
    </div>
@endsection
