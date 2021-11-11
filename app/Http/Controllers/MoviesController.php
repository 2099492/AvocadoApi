<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MoviesController extends Controller
{
    public function index() {
        $response = Http::get('https://swapi.dev/api/films/');
        Cache::add('movies', json_decode($response->body()), now()->addMinutes(60));
        $movies = Cache::get('movies');
        return view('welcome', compact('movies'));
    }

    public function store() {
        request()->validate([
            'movie_id' => 'required',
        ]);

        Movie::firstOrCreate([
            'movie_id' => request('movie_id'),
            'favorite' => 1
        ]);

        return redirect()->back();
    }

    public function showAll() {
        $favorites = Movie::all();
        $movies = Cache::get('movies');
        $movies = collect($movies->results);
        return view('favorites', compact('movies', 'favorites'));
    }

    public function show($id) {
        $response = Http::get('https://swapi.dev/api/films/' . $id);
        $movie = json_decode($response->body());
        return view('show', compact('movie'));
    }

    public function destroy(Movie $movie) {
        $movie->delete();
        return redirect()->back();
    }
}
