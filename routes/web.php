<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ToDoController;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/ajax-spa');
});

Route::get('/ajax-spa', function () {
    return view('ajax-spa');
});

Route::get('/ajax-spa/to-dos/{id}',     [ToDoController::class, 'show'])    ->name('todos.show');
Route::post('/ajax-spa/to-dos',         [ToDoController::class, 'store'])   ->name('todos.store');
Route::delete('/ajax-spa/to-dos/{id}',  [ToDoController::class, 'destroy']) ->name('todos.destroy');