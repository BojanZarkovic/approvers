<?php

use App\Http\Controllers\Approvals;
use App\Http\Controllers\Employees;
use App\Http\Controllers\Jobs;
use App\Http\Controllers\Reports;
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


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/employees', [Employees::class, 'index']);
    Route::get('/employees/{userId}', [Employees::class, 'get']);

    Route::get('/jobs/{jobId}', [Jobs::class, 'get']);
    Route::get('/jobs', [Jobs::class, 'index']);
    Route::post('/jobs', [Jobs::class, 'create']);

    Route::get('/approval/{approvalId}', [Approvals::class, 'get']);
    Route::get('/approval', [Approvals::class, 'index']);
});


Route::group(['middleware' => ['auth:sanctum', 'isSuperAdmin']], function () {

    Route::get('/approvers/{userId}', [Approvers::class, 'get']);
    Route::get('/approvers', [Approvers::class, 'index']);
    Route::post('/approvers', [Approvers::class, 'create']);
    Route::put('/approvers/{userId}', [Approvers::class, 'edit']);
    Route::delete('/approvers/{userId}', [Approvers::class, 'softDelete']);

    Route::post('/employees', [Employees::class, 'create']);
    Route::put('/employees/{userId}', [Employees::class, 'edit']);
    Route::delete('/employees/{userId}', [Employees::class, 'softDelete']);

    Route::delete('/jobs/{jobId}', [Jobs::class, 'softDelete']);

    Route::get('/report/{userId}', [Reports::class, 'get']);
});

Route::group(['middleware' => ['auth:sanctum', 'isApprover']], function () {

    Route::post('/approval', [Approvals::class, 'create']);
    Route::put('/approval/{approvalId}', [Approvals::class, 'edit']);
    Route::delete('/approval/{approvalId}', [Approvals::class, 'softDelete']);
});


// return 404 for all other routes
Route::any('{all}', function () {
    return response()->json(['error'=>'API endpoint not found.'], 404);
})->where('all', '.*');
