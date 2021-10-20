<?php

use App\Http\Controllers\StudioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookingStudioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//list studio
Route::get('/studio', [StudioController::class, 'index']);
Route::get('/studio/{id}', [StudioController::class, 'detailStudio']);
Route::get('/studio/status/{studio_status}', [StudioController::class, 'filterByStatus']);
Route::get('/studio/day/{studio_available_day}', [StudioController::class, 'filterByDay']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    

    //ADMIN ACCESS
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('admin');
    Route::post('/studio', [StudioController::class, 'store'])->middleware('admin');
    Route::put('/studio/{id}', [StudioController::class, 'update'])->middleware('admin');
    Route::delete('/studio/{id}', [StudioController::class, 'destroy'])->middleware('admin');
    Route::get('/userAll', [UserController::class, 'userAll'])->middleware('admin');
    Route::put('/booking/studio/approved/{id}', [BookingStudioController::class, 'AcceptBookingStudio'])->middleware('admin');
    Route::delete('/booking/studio/delete/{id}', [BookingStudioController::class, 'deleteBookingStudio'])->middleware('admin');
    Route::get('/booking/studio/all', [BookingStudioController::class, 'allBookingStudio'])->middleware('admin');

    //USER ACCES
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
 
    //Booking Studio 
    Route::post('/booking/studio/add', [BookingStudioController::class, 'createBookingStudio']);
    Route::get('/mystudio/{name}', [BookingStudioController::class, 'MyBookingStudio']);
    Route::put('/booking/studio/cancel/{id}', [BookingStudioController::class, 'cancelBookingStudio']);
       
    //ADMIN DAN USER
    Route::post('/logout', [AuthController::class, 'logout']);
    
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
