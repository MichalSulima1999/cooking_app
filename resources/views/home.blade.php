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

                    <h1>{{ __('Hello') }} {{ Auth::user()->username }}!</h1>
                    <h2>{{ __('Let\'s cook something wonderful together!') }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
