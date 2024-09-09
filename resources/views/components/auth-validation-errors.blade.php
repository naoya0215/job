@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    </div>
@endif
