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
{{--{{ dd($movies, $favorites) }}--}}
<a href="{{ route('movies.index') }}">
    <x-button class="mt-12 ml-12">
        View movies
    </x-button>
</a>
<ul class="list-inside list-decimal shadow-2xl bg-opacity-70 rounded bg-blue-200 m-12 mt-3">
    <div class="divide-y-4 divide-gray-500 divide-solid">
        @foreach($favorites as $favorite)
            <div class="flex justify-between p-1">
                <li class="p-3">
                    {{ $movies->where('episode_id', '=', $favorite->movie_id)->firstOrFail()->title }}
                    <br>
                    {{ $movies->where('episode_id', '=', $favorite->movie_id)->firstOrFail()->opening_crawl }}
                </li>
                <form action="{{ route('movies.destroy', $favorite->id) }}" method="post" class="my-auto">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $favorite->id }}">
                    <x-button>Remove from favorites</x-button>
                </form>
            </div>
        @endforeach
    </div>
</ul>
</body>
</html>
