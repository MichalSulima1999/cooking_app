@extends('layouts.app')

@section('content')
    <a class="btn btn-primary" data-bs-toggle="collapse" href="#searchCollapse" role="button" aria-expanded="false"
        aria-controls="searchCollapse">
        Wyszukiwarka
    </a>
    <div class="collapse" id="searchCollapse">
        <div class="card card-body">
            <form action="{{ route('recipes.index') }}" method="GET" role="search">

                <div class="input-group">
                    <input type="text" class="form-control me-1" name="term" placeholder="Wyszukaj przepisy" id="term">
                    <span class="input-group-btn me-1 mt-1">
                        <button class="btn btn-info" type="submit" title="Search projects">
                            Szukaj
                        </button>
                    </span>
                    <a href="{{ route('recipes.index') }}" class="mt-1">
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button" title="Refresh page">
                                Reset
                            </button>
                        </span>
                    </a>
                </div>
                <div class="mt-3 row">
                    <h3>Posiłek</h3>
                    @forelse ($meals as $meal)
                        <div class="form-check col-sm-6">
                            <input class="form-check-input" type="checkbox" value="{{ $meal->id }}"
                                id="flex{{ $meal }}" name="meals[]">
                            <label class="form-check-label" for="flex{{ $meal }}">
                                {{ $meal->name }}
                            </label>
                        </div>
                    @empty
                        <h1>Błąd bazy danych</h1>
                    @endforelse
                </div>
                @auth
                    <div class="form-check mt-3 form-switch">
                        <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="myRecipes">
                        <label class="form-check-label" for="flexCheckDefault">
                            Moje przepisy
                        </label>
                    </div>
                @endauth
            </form>
        </div>
    </div>

    <h1 class="text-center shadow-sm">Przepisy</h1>
    <div class="row">
        @forelse ($recipes as $recipe)
            <div class="card text-white bg-dark col-sm-3 m-2" style="width: 18rem;">
                <img src="{{ asset('images/' . $recipe->image_path) }}" class="card-img-top"
                    alt={{ $recipe->name . ' photo' }}>
                <div class="card-body">
                    <h5 class="card-title">{{ $recipe->name }}</h5>
                    <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                    <p class="card-text mb-1"><small class="text-muted">{{ $recipe->user->username }}</small></p>
                    <p class="card-text"><small
                            class="text-muted">{{ date_format($recipe->created_at, 'd.m.y') }}</small></p>
                    <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary stretched-link">Wyświetl przepis</a>
                </div>
            </div>
        @empty
            <p>Brak wyników</p>
        @endforelse


    </div>
    <div>
        {{ $recipes->links() }}
    </div>
@endsection
