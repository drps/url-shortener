<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="col">
        <a href="{{ route('home') }}">Home</a>
    </div>
</div>
@if ($shortUrl)
<div class="row">
    <div class="col">
        <a href="{{ route('short', $shortUrl->short_url) }}">{{ route('short', $shortUrl->short_url) }}</a>
    </div>
</div>
<div class="row">
    <div class="col">
        <a href="{{ url('/stat', ['url' => $shortUrl]) }}">Просмотр статистики</a>
    </div>
</div>
@endif
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
