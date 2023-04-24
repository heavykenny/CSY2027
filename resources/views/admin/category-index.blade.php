@extends('admin.layouts.admin')

@section('title', 'All Category')

@section('content')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-sm-8">
                <h1>All Categories</h1>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                      style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('categories.create') }}" class="btn btn-success">Add Category</a>

            </div>

        </div>
        <!-- content-wrapper ends -->
        @include('admin.layouts.inner-footer')
    </div>
@endsection
