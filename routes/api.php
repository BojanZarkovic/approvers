<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth;
use App\Http\Controllers\Approvers;

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

// APPROVERS CRUD, MUST BE SUPER ADMIN TO ACCESS
Route::group(['middleware' => ['auth:sanctum', 'isSuperAdmin']], function () {

    Route::get('/approvers/{userId}', [Approvers::class, 'get']);
    Route::get('/approvers', [Approvers::class, 'index']);
    Route::post('/approvers', [Approvers::class, 'create']);
    Route::put('/approvers/{approverId}', [Approvers::class, 'edit']);
    Route::delete('/approvers/{approverId}', [Approvers::class, 'softDelete']);

});


// return 404 for all other routes
Route::any('{all}', function () {
    return response()->json(['error'=>'API endpoint not found.'], 404);
})->where('all', '.*');
