@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Zalogowano') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Witaj {{ Auth::user()->username }}!</h1>
                    <h2>Ugotujmy razem coś wspaniałego!</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
