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

{{--@if ($errors->any())--}}
{{--    <div class="text-center alert alert-danger">--}}
{{--        @foreach ($errors->all() as $error)--}}
{{--            <span>{{ $error }} <br></span>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--@endif--}}
