<ul class="navbar-nav ms-auto">
    @foreach ($menu as $item)
    <li class="nav-item">
        <a href="{{ route($item['route']) }}" class="@if($item['active']) text-decoration-underline @endif nav-link">
            {{ $item['title']  }}
        </a>
    </li>
    @endforeach
    
    <!-- Ссылки аунтефикации -->
    @guest
    @if (Route::has('login'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Авторизация</a>
    </li>
    @endif

    @if (Route::has('register'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
    </li>
    @endif
    @else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                {{ __('Выход') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </li>
    @endguest
</ul>