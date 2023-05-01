@extends('admin.layouts.admin')

@section('title', 'Create Client')

@section('content')

    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <h1>Create Client</h1>
                <hr>

                <form method="POST" action="{{ route('client.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="role">Role:</label>
                        <select name="vendor_id" id="vendor_id" class="form-control">
                            <option value="{{ old('vendor_id') }}">-- Select a Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="vendor">Vendor:</label>
                        <select name="vendor_id" id="vendor_id" class="form-control">
                            <option value="{{ old('vendor_id') }}">-- Select a vendor --</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                            @endforeach
                        </select>

                        @error('vendor_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary">Create Client</button>
                    <button type="button" class="btn btn-warning"
                            onclick="window.location='{{ route('vendor.index') }}'">Cancel
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
