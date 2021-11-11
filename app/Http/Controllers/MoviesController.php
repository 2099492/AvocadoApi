<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MoviesController extends Controller
{
    public function index() {
        $url = 'https://swapi.dev/api/films/';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = json_decode(curl_exec($curl));
        $movies = collect($data->results);
        curl_close($curl);
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
        $url = 'https://swapi.dev/api/films/';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $data = json_decode(curl_exec($curl));
        $movies = collect($data->results);
        curl_close($curl);
        return view('favorites', compact('movies', 'favorites'));
    }

    public function show($id) {
        $url = 'https://swapi.dev/api/films/' . $id;
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            "Accept: application/json",
        );
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $movie = json_decode(curl_exec($curl));
        curl_close($curl);
        return view('show', compact('movie'));
    }

    public function destroy(Movie $movie) {
        $movie->delete();
        return redirect()->back();
    }
}
