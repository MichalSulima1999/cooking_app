@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="/recipes/{{ $recipe->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <h1 class="text-center fw-bold shadow-sm bg-body rounded">{{ __('Edit recipe') }}</h1>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label h3">{{ __('Photo') }}</label>
            <input type="file" id="image" class="form-control" name="image" placeholder="{{ __('Upload a photo...') }}">
        </div>

        <div class="mb-3">
            <label for="name" class="form-label h3">{{ __('Recipe name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $recipe->name }}" required>
        </div>

        <div class="mb-3">
            <label for="meal" class="form-label h3">{{ __('Meal') }}</label>
            <select class="form-select" id="meal" aria-label="Meals" name="meal" required>
                @foreach ($meals as $meal)
                    <option value="{{ $meal->id }}" @if ($recipe->meal_id === $meal->id)
                        selected
                @endif
                >
                {{ $meal->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <h3>{{ __('Ingredients') }}</h3>
            @php
                $i = 1000;
            @endphp
            @foreach ($ingredients as $ingredient)
                <div id="row{{ $i }}" class="dynamic-added row pt-2">
                    <div class="col-sm-11">
                        <input type="text" name="ingredients[]" value="{{ $ingredient }}"
                            class="form-control name_list" />
                    </div>
                    @if ($i != 1000)
                        <div class="col-sm-1">
                            <button type="button" name="remove" id="{{ $i }}"
                                class="btn btn-danger btn_remove  w-100">X</button>
                        </div>
                    @endif
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
            <div id="dynamic_field"></div>
            <button type="button" name="add" id="add" class="btn btn-success mt-2">{{ __('Add ingredient') }}</button>
        </div>

        <div class="mb-3">
            <label for="desc" class="form-label h3">{{ __('Preparation description:') }}</label>
            <textarea class="form-control" id="desc" rows="3" name="description" required minlength="25">
                        {{ $recipe->description }}
                    </textarea>
        </div>

        <div class="mb-3">
            <h3>{{ __('Preparation time:') }}</h3>
            <div class="row">
                <div class="col">
                    <label for="hours" class="form-label">{{ __('Hours:') }}</label>
                    <input type="number" class="form-control" id="hours" name="hours" min="0"
                        value="{{ $hours = floor($recipe->cooking_time / 60) }}" required>
                </div>
                <div class="col">
                    <label for="minutes" class="form-label">{{ __('Minutes:') }}</label>
                    <input type="number" class="form-control" id="minutes" name="minutes" min="0" max="60"
                        value="{{ $recipe->cooking_time - 60 * $hours }}" required>
                </div>
            </div>

        </div>

        <input type="submit" name="submit" id="submit" class="btn btn-info" value="{{ __('Edit recipe') }}" />
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;


            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div id="row' + i +
                    '" class="dynamic-added row pt-2"><div class="col-sm-11"><input type="text" name="ingredients[]" placeholder="{{ __("Chicken - 300g") }}" class="form-control name_list" /></div> <div class="col-sm-1"><button type="button" name="remove" id="' +
                    i + '" class="btn btn-danger btn_remove  w-100">X</button></div></div>');
            });


            $(document).on('click', '.btn_remove', function() {
                var button_id = $(this).attr("id");
                $('#row' + button_id + '').remove();
            });


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
@endsection
