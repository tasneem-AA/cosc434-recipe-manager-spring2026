<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return redirect()->route('recipes.index');
});
Route::get('/show', function () {
    return view('recipes.show');
});

Route::get('/login-demo', function (Request $request) {
    session(['logged_in' => true]);
    return redirect('/recipes')->with('success', 'You are now logged in!');
});

Route::get('/logout-demo', function (Request $request) {
    session()->forget('logged_in');
    return redirect('/recipes')->with('success', 'You are now logged out!');
});


Route::resource('recipes', RecipeController::class)->middleware('demo.auth', [
    'create', 'store', 'edit', 'update', 'destroy'
]);