@if ($errors->any())
    <ul class="errors">
        @foreach ($errors->all() as $erro)
            <li class="errors">{{ $erro }}</li>
        @endforeach
    </ul>
@endif
