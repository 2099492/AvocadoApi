<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [MoviesController::class, 'index'])->name('movies.index');
Route::post('/', [MoviesController::class, 'store'])->name('movies.store');
Route::get('/movie/{id}', [MoviesController::class, 'show'])->name('movies.show');
Route::get('/favorites', [MoviesController::class, 'showAll'])->name('movies.showAll');
Route::delete('/favorites/{movie}', [MoviesController::class, 'destroy'])->name('movies.destroy');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
