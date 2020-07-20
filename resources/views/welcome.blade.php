<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<main>
    <section id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container">
                <div class="row text-white">
                    <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                        <h1 class="display-4 py-2 text-truncate">Url shortener</h1>
                        <div class="px-2">
                            <form action="{{ route('encode') }}" method="POST" class="justify-content-center">
                                @csrf
                                <div class="form-group">
                                    <label class="sr-only">Url</label>
                                    <input type="text" class="form-control" id="url" name="url" placeholder="Enter url" value="{{ old('url') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="short" class="sr-only">Short</label>
                                    <input type="text" class="form-control" id="short" name="short" value="{{ old('short') }}" placeholder="short url">
                                </div>
                                <div class="form-group">
                                    <label for="expire" class="sr-only">Expire</label>
                                    <input type="date" class="form-control" id="expire" name="expire" value="{{ old('expire') }}">
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="commercial"
                                                    value="1"
                                                    {{ old('commercial') ? 'checked' : '' }}
                                            > Commercial
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg">Launch</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
