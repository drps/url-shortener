<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
<a href="{{ route('home') }}">Home</a><br>

<div class="row">
    <div class="col-xl-9">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Url</th>
                <th>short path</th>
                <th>Expire At</th>
                <th>Commercial</th>
                <th>IP</th>
                <th>Count</th>
                <th>Create At</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($stats as $stat)
                <tr>
                    <td>{{ $stat->id }}</td>
                    <td>{{ $stat->url }}</td>
                    <td>{{ $stat->short_url }}</td>
                    <td>{{ $stat->expire_at }}</td>
                    <td>{{ $stat->is_commercial }}</td>
                    <td>{{ $stat->ip }}</td>
                    <td>{{ $stat->cnt }}</td>
                    <td>{{ $stat->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
