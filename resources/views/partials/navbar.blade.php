
<li class="nav-item" {{ Route::is('person') ? 'active' : '' }}>
    <a class="nav-link" href="{{ route('person') }}">Balance</a>
</li>
<li class="nav-item" {{ Route::is('transfer') ? 'active' : '' }}>
    <a class="nav-link" href="{{ route('transfer') }}">Transfer</a>
</li>
{{-- <li class="nav-item" {{ Route::is('undangan') ? 'active' : '' }}>
    <a class="nav-link" href="{{ route('undangan') }}">Undangan</a>
</li>
<li class="nav-item" {{ Route::is('input-data') ? 'class=active' : '' }}>
    <a class="nav-link" href="{{ route('input-data') }}">Input</a>
</li> --}}

