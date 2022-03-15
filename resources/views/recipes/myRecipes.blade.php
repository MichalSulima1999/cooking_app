@extends('layouts.app')

@section('content')
    <h1 class="text-center shadow-sm">Przepisy</h1>
    <div class="row">
        @foreach ($recipes as $recipe)

            <div class="card text-white bg-dark col-sm-3 m-2" style="width: 18rem;">
                <img src="{{ asset('images/' . $recipe->image_path) }}" class="card-img-top"
                    alt={{ $recipe->name . ' photo' }}>
                <div class="card-body">
                    <h5 class="card-title">{{ $recipe->name }}</h5>
                    <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                    <p class="card-text mb-1"><small class="text-muted">{{ $recipe->user->username }}</small></p>
                    <p class="card-text"><small
                            class="text-muted">{{ date_format($recipe->created_at, 'd.m.y') }}</small></p>
                    <a href="/recipes/{{ $recipe->id }}" class="btn btn-primary w-100 mb-2">{{ __('Show recipe') }}</a>
                    <a href="{{ $recipe->id }}/edit" class="btn btn-secondary w-100 mb-2">{{ __('Edit recipe') }}</a>
                    <form action="/recipes/{{ $recipe->id }}" method="POST" class="d-grid gap-2">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger mb-4 w-100 mb-2">
                            {{ __('Delete') }} &rarr;
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <div>
        {{ $recipes->links() }}
    </div>
@endsection
