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
        <a href="{{ route('home') }}">Home</a><br>
    </div>
</div>

<div class="row">
    <div class="col-xl-9">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Image</th>
                <th>IP</th>
                <th>Create At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($stats as $stat)
                <tr>
                    @if ($stat->img)
                        <td>
                            <img src="{{ asset($stat->img) }}" alt="" width="40">
                        </td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $stat->ip }}</td>
                    <td>{{ $stat->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{ $stats->links() }}

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
