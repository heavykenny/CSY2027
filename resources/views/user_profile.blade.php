@extends("blank")

@section('title', 'User Profile')

@section("content")
    <div class="container">
        <h1 class="my-3">User Profile</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Personal Information</h5>
                        <form>
                            <div class="form-group">
                                <label for="firstName">Full Name</label>
                                <input type="text" class="form-control" id="firstName" value="{{ $user->name  }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                       readonly>
                            </div>
                            <div class="form-group">
                                <label for="Address">Address</label>
                                <input type="text" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label for="Post Code">Postcode</label>
                                <input type="text" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label for="Country">Country</label>
                                <input type="text" class="form-control" value="">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" value="">
                            </div>
                            <button type="submit" class="btn btn-primary p-3 m-3">Update Information</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Change Password</h5>
                        <form>
                            <div class="form-group">
                                <label for="currentPassword">Current Password</label>
                                <input type="password" class="form-control" id="currentPassword">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password</label>
                                <input type="password" class="form-control" id="newPassword">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm Password</label>
                                <input type="password" class="form-control" id="confirmPassword">
                            </div>
                            <button type="submit" class="m-3 p-3 btn btn-primary">Change Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
