@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="row pb-4">
        <div class="col-md-12 col-lg-6 text-center shadow-sm">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h1>{{ $recipe->name }}</h1>
                </li>
                <li class="list-group-item">
                    <h3>{{ __('Preparation time:') }}
                        {{ $hours = floor($recipe->cooking_time / 60) }}h {{ $recipe->cooking_time - 60 * $hours }}m
                    </h3>
                </li>
                <li class="list-group-item mb-4">
                    <h3 class="text-muted">{{ $recipe->meal->name }}</h3>
                </li>
            </ul>

            @auth
                <div class="text-info text-center shadow-sm rounded bg-white">
                    @php
                        $ratedBool = false;
                        if ($rated !== null) {
                            $ratedBool = true;
                        }
                    @endphp
                    <h3>{{ __('Rate:') }}</h3>
                    <form action="@if ($ratedBool) /ratings/{{ $rated->id }} @else /ratings/ @endif" method="POST" id="rateForm">
                        @csrf
                        <div>
                            @if ($ratedBool)
                                @method('PATCH')
                            @else
                                <input type="hidden" name="_method" value="POST" id="methodChange">
                            @endif
                        </div>

                        <div class="mb-4 row">
                            <div class="rating">
                                @for ($i = 5; $i > 0; $i--)
                                    <input type="radio" name="rate" value="{{ $i }}" id="{{ $i }}"
                                        @if ($ratedBool && $rated->rating === $i)
                                    checked
                                    @endif><label for="{{ $i }}">☆</label>
                                @endfor
                            </div>
                            <input type="hidden" name="id" value="{{ $recipe->id }}">
                        </div>

                    </form>
                </div>

            @endauth

            <div class="text-success text-center shadow-sm rounded bg-white">
                <h3>{{ __('Rating:') }}</h3>
                <h2 id="ratingAvg">
                    @if (App\Http\Controllers\RecipesController::getRating($recipe->id) == 0)
                        -/5
                    @else
                        {{ round(App\Http\Controllers\RecipesController::getRating($recipe->id), 2) }}/5
                    @endif

                </h2>
            </div>


            @if (isset(Auth::user()->id) && Auth::user()->id == $recipe->user_id)
                <div class="d-grid gap-2">
                    <a class="btn btn-secondary btn-lg mb-4" href="{{ $recipe->id }}/edit">
                        {{ __('Edit') }} &rarr;
                    </a>

                    <form action="/recipes/{{ $recipe->id }}" method="POST" class="d-grid gap-2">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-lg mb-4">
                            {{ __('Delete') }} &rarr;
                        </button>
                    </form>
                </div>
            @endif
        </div>
        <div class="col-md-12 col-lg-6">
            <img src="{{ asset('images/' . $recipe->image_path) }}" class="img-thumbnail rounded shadow w-100"
                alt="{{ $recipe->name . ' photo' }}">
        </div>
    </div>

    <div class="row pb-4">
        <div class="col-md-12 col-lg-6">
            <ul class="list-group">
                <li class="list-group-item list-group-item-primary">{{ __('Ingredients') }}</li>
                @foreach ($ingredients as $ingredient)

                    <li class="list-group-item">{{ $ingredient }}</li>

                @endforeach
            </ul>
        </div>
        <div class="col-md-12 col-lg-6">
            <h3>{{ __('Preparation description:') }}</h3>
            <p class="text-break" style="white-space: pre-wrap;">{{ $recipe->description }}</p>
        </div>
    </div>

    <div class="bg-white">
        <h1 class="text-center">{{ __('Comments') }}</h1>

        @auth
            <form class="m-3" action="/comments/" method="POST">
                @csrf
                <textarea class="form-control mb-2" name="comment" id="comment" rows="6"></textarea>
                <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">
                <button class="btn btn-primary" id="submitComment" type="submit">Wyślij komentarz</button>
            </form>
        @endauth

        <div id="comments">
            @foreach ($comments as $comment)
                <div class="m-3 bg-light border shadow-sm">
                    @if (isset(Auth::user()->id) && Auth::user()->id == $comment->user_id)
                        <form action="/comments/{{ $comment->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="bg-dark text-white">
                                <p class="ps-2">{{ $comment->user->username }}</p>
                            </div>
                            <textarea class="ps-2 form-control mb-2" name="comment"
                                onclick='this.style.height = "";this.style.height = this.scrollHeight + "px"; $("#editComment{{ $comment->id }}").show()'>{{ $comment->comment }}</textarea>
                            <button class="btn btn-success" type="submit" id="editComment{{ $comment->id }}"
                                style='display:none;'>{{ __('Edit comment') }}</button>
                        </form>

                    @else
                        <div class="bg-secondary text-white">
                            <p class="ps-2">{{ $comment->user->username }}</p>
                        </div>
                        <h5 class="ps-2" style="white-space: pre-wrap;">{{ $comment->comment }}</h5>
                    @endif

                </div>
            @endforeach
        </div>
    </div>

    <script type="text/javascript">
        $('#rateForm').change('.rate', function(e) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });
            $.ajax({
                type: 'POST',
                cache: false,
                dataType: 'JSON',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                complete: function(ratingId) {
                    $.ajax({
                        type: "GET",
                        url: "/getRating/{{ $recipe->id }}",
                        complete: function(data) {
                            $("#ratingAvg").html(data.responseText + "/5");
                        }
                    });
                    $('#rateForm').attr('action', "/ratings/" + ratingId.responseText);
                    $('#methodChange').val("PATCH");
                }
            });
        });
    </script>
@endsection
