@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form action="/recipes" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <h1 class="text-center fw-bold shadow-sm bg-body rounded">Stwórz przepis</h1>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label h3">Zdjęcie dania</label>
            <input type="file" id="image" class="form-control" name="image" placeholder="Wyślij zdjęcie..." required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label h3">Nazwa przepisu</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="meal" class="form-label h3">Posiłek</label>
            <select class="form-select" id="meal" aria-label="Default select example" name="meal" required>
                @foreach ($meals as $meal)
                    <option value="{{ $meal->id }}">
                        {{ $meal->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <h3>Składniki</h3>
            <input type="text" class="form-control" name="ingredients[]" placeholder="Kurczak - 300g" required>
            <div id="dynamic_field"></div>
            <button type="button" name="add" id="add" class="btn btn-success mt-2">Dodaj składnik</button>
        </div>

        <div class="mb-3">
            <label for="desc" class="form-label h3">Opis przygotowania:</label>
            <textarea class="form-control" id="desc" rows="3" name="description" required minlength="25"></textarea>
        </div>

        <div class="mb-3">
            <h3>Czas przygotowania</h3>
            <div class="row">
                <div class="col">
                    <label for="hours" class="form-label">Godziny:</label>
                    <input type="number" class="form-control" id="hours" name="hours" min="0" value="0" required>
                </div>
                <div class="col">
                    <label for="minutes" class="form-label">Minuty:</label>
                    <input type="number" class="form-control" id="minutes" name="minutes" min="0" max="60" value="0"
                        required>
                </div>
            </div>

        </div>

        <input type="submit" name="submit" id="submit" class="btn btn-info" value="Dodaj przepis!" />
    </form>

    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;


            $('#add').click(function() {
                i++;
                $('#dynamic_field').append('<div id="row' + i +
                    '" class="dynamic-added row pt-2"><div class="col-sm-11"><input type="text" name="ingredients[]" placeholder="Kurczak - 300g" class="form-control name_list" /></div> <div class="col-sm-1"><button type="button" name="remove" id="' +
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
