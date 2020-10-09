<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('todo', [TodoController::class, 'index']);

Route::post('todo', [TodoController::class, 'store']);
Route::put('todo/changeDoneStatus/{id}', [TodoController::class, 'changeDoneStatus']);

Route::put('todo/delete/{id}', [TodoController::class, 'delete']);
