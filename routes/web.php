<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\RecipesController;
use Illuminate\Support\Facades\Route;

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
Route::get('/recipes/myRecipes',[RecipesController::class, 'myRecipes'])->name('recipes.myRecipes');
Route::resource('/recipes', RecipesController::class);
Route::get('/getRating/{id}',[RecipesController::class, 'getRating']);


Route::post('/recipes/rating', 'RecipesController@rating')->name('rating');

Route::resource('/ratings', RatingsController::class);

Route::resource('/comments', CommentsController::class);



Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('language/{locale}', function ($locale) {
    app()->setLocale($locale);
    session()->put('locale', $locale);
    return redirect()->back();
});