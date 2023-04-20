@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <p class="bg-reddit">{{ $error }}</p>
            @endforeach
        </ul>
    </div>
@endif
