@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-3">Gotuj razem z nami!</h1>
    <div class="row text-center">

        <div class="col-md-12 col-lg-6">
            @guest
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">Zaloguj się!</h2>
                        <p class="card-text h4 mt-auto">Zaloguj się i wróć do tworzenia i oceniania przepisów!</p>
                        <a href="/login" class="btn btn-primary stretched-link mt-auto">Zaloguj</a>
                    </div>
                </div>
            @endguest

            @auth
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">Stwórz przepis!</h2>
                        <p class="card-text h4 mt-auto">Stwórz nowy przepis który pokochają wszyscy nasi użytkowicy!</p>
                        <a href="/recipes/create" class="btn btn-primary stretched-link mt-auto">Twórz przepis</a>
                    </div>
                </div>
            @endauth
        </div>

        <div class="col-md-12 col-lg-6">
            @guest
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">Zarejestruj się!</h2>
                        <p class="card-text h4 mt-auto">Dołącz do nas i podziel się ze wszystkimi swoimi ulubionymi przepisami!</p>
                        <a href="/register" class="btn btn-primary stretched-link mt-auto">Rejestruj</a>
                    </div>
                </div>
            @endguest

            @auth
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">Przeglądaj swoje przepisy!</h2>
                        <p class="card-text h4 mt-auto">Przejrzyj swoje przepisy, aktualizuj je, odpowiadaj na komentarze innych!</p>
                        <a href="/recipes/myRecipes" class="btn btn-primary stretched-link mt-auto">Przeglądaj</a>
                    </div>
                </div>
            @endauth
        </div>

        <div class="col-md-12 col-lg-6">
            <div class="card welcome-card">
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">Przeglądaj wszystkie przepisy!</h2>
                    <p class="card-text h4 mt-auto">Przeglądaj przepisy na smaczne dania umieszczone przez naszych użytkowników!</p>
                    <a href="/recipes" class="btn btn-primary stretched-link mt-auto">Przeglądaj</a>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-6">
            <div class="card welcome-card">
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">O nas</h2>
                    <p class="card-text h4 mt-auto">Przeczytaj o naszej stronie!</p>
                    <a href="/about" class="btn btn-primary stretched-link mt-auto">O nas</a>
                </div>
            </div>
        </div>
    </div>
@endsection
