<div class="navigation">
    <nav class="main-navigation">
        <h2 class="main-navigation--title hidden">Navigation principale</h2>

        <a class="main-navigation--link" href="/">Accueil</a>

        @guest
            <a class="main-navigation--link" href="{{ route('login') }}">Se connecter</a>
        @else
            <a class="main-navigation--link" href="{{ route('events.index') }}">Épreuves</a>
            <a class="main-navigation--link" href="{{ route('users.index') }}">Jury</a>

            <a class="main-navigation--link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                Se déconnecter
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        @endguest
    </nav>
</div>
