   <!-- Nav tabs -->
   <ul class="nav nav-tabs" id="navId">
    <li class="nav-item">
        <a href="/" class="nav-link">Главная</a>
    </li>
    @auth
    <li class="nav-item">
        <a href="/bucket" class="nav-link">Корзина</a>
    </li>
        @if (!Auth::user()->isAdmin)
        @else
            <li class="nav-item">
                <a href="/admin/items/create" class="nav-link">Админ панель</a>
            </li>
            @endif
            <div class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
            
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
            
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
        </div>
    @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
    @endauth
</ul>
