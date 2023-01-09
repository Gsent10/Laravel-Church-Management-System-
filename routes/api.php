<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\CellController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\AttendanceController;
use App\Http\Controllers\Api\DataController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::get('/members', [MemberController::class, 'index']);
//Route::post('/members', [MemberController::class, 'store']);

Route::put('/members/{id}/add-cell-member', [DataController::class, 'inputCell']);
Route::put('/members/{id}/add-department-member', [DataController::class, 'inputDepartment']);
Route::put('/members/{id}/mark-member-present', [DataController::class, 'markAttendance']);
Route::get('/members/attendaces/{id}', [DataController::class, 'getAttendances']);
Route::get('/members/{id}/department-members', [DataController::class, 'departments']);

Route::apiResource('members', MemberController::class);
Route::apiResource('cells', CellController::class);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('events', EventController::class);
Route::apiResource('attendances', AttendanceController::class);