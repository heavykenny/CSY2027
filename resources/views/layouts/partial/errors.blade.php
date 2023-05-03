@if (session('success'))
    <div class="text-center alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="text-center alert alert-danger">
        {{ session('error') }}
    </div>
@endif
