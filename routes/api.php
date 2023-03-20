<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [Auth::class, 'login']);



// TODO DELETE THIS ROUTE
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// return 404 for all other routes
Route::any('{all}', function () {
    return response()->json(['error'=>'API endpoint not found.'], 404);
})->where('all', '.*');
