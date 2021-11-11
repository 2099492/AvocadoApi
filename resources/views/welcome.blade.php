<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
{{--{{ dd($movies) }}--}}
<a href="{{ route('movies.showAll') }}">
    <x-button class="mt-12 ml-12">
        View favorites
    </x-button>
</a>
<ul class="list-inside list-decimal shadow-2xl bg-opacity-70 rounded bg-blue-200 m-12 mt-3">
    <div class="divide-y-4 divide-gray-500 divide-solid">
        @foreach($movies as $movie)
        <div class="flex justify-between p-1">
            <li>
                {{ $movie->title }}
            </li>
            <form action="{{ route('movies.store') }}" method="post">
                @csrf
                <input type="hidden" name="movie_id" value="{{ $movie->episode_id }}">
                <x-button>Save as favorite</x-button>
            </form>
        </div>
        @endforeach
    </div>
</ul>
</body>
</html>
