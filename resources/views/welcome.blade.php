@extends('layouts.app')

@section('content')
    <h1 class="text-center mb-3">{{ __('Cook with us!') }}</h1>
    <div class="row text-center">

        <div class="col-md-12 col-lg-6">
            @guest
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">{{ __('Log in!') }}</h2>
                        <p class="card-text h4 mt-auto">{{ __('Log in and get back to creating and rating recipes!') }}</p>
                        <a href="/login" class="btn btn-primary stretched-link mt-auto">{{ __('Log in!') }}</a>
                    </div>
                </div>
            @endguest

            @auth
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">{{ __('Create recipe!') }}</h2>
                        <p class="card-text h4 mt-auto">{{ __('Create a new recipe that everyone will love!') }}</p>
                        <a href="/recipes/create" class="btn btn-primary stretched-link mt-auto">{{ __('Create recipe!') }}</a>
                    </div>
                </div>
            @endauth
        </div>

        <div class="col-md-12 col-lg-6">
            @guest
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">{{ __('Register!') }}</h2>
                        <p class="card-text h4 mt-auto">{{ __('Join us and share with all your favorite recipes!') }}</p>
                        <a href="/register" class="btn btn-primary stretched-link mt-auto">{{ __('Register!') }}</a>
                    </div>
                </div>
            @endguest

            @auth
                <div class="card welcome-card">
                    <div class="card-body d-flex flex-column">
                        <h2 class="card-title">{{ __('Check your recipes!') }}</h2>
                        <p class="card-text h4 mt-auto">{{ __('Review your recipes, update them, reply to comments from others!') }}</p>
                        <a href="/recipes/myRecipes" class="btn btn-primary stretched-link mt-auto">{{ __('Check your recipes!') }}</a>
                    </div>
                </div>
            @endauth
        </div>

        <div class="col-md-12 col-lg-6">
            <div class="card welcome-card">
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">{{ __('Browse all recipes!') }}</h2>
                    <p class="card-text h4 mt-auto">{{ __('Browse recipes for tasty dishes posted by our users!') }}</p>
                    <a href="/recipes" class="btn btn-primary stretched-link mt-auto">{{ __('Browse all recipes!') }}</a>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-6">
            <div class="card welcome-card">
                <div class="card-body d-flex flex-column">
                    <h2 class="card-title">{{ __('About us') }}</h2>
                    <p class="card-text h4 mt-auto">{{ __('Read about our site!') }}</p>
                    <a href="/about" class="btn btn-primary stretched-link mt-auto">{{ __('About us') }}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
