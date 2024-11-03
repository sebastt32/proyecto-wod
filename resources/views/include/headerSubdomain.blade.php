@php
    $links = [
        ['name' => 'Dashboard', 'url' => route('home'), 'active' => 'dashboard'],
        ['name' => 'Tareas', 'url' => route('tasks.index'), 'active' => 'dashboard'],
        ['name' => 'Home', 'url' => route('home'), 'active' => 'tasks*'],
    ];
@endphp



<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">



                @foreach ($links as $link)
                    @if (request()->is($link['active']))
                        <li class="nav-link">
                            <a href="{{ $link['url'] }}">{{ $link['name'] }}</a>
                        </li>
                    @endif
                @endforeach
                {{-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li> --}}


                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Log out</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front.2fa') }}">Double Auth</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('registration') }}">Registration</a>
                    </li>
                @endauth

            </ul>
            <span class="navbar-text">
            @auth{{ auth()->user()->name }};@endauth
        </span>
    </div>
</div>
</nav>
