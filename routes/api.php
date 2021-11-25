<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudioController;
use App\Http\Controllers\BookingStudioController;
use App\Http\Controllers\InstrumentController;
use App\Http\Controllers\BookingAlatController;
use App\Http\Controllers\BlogController;
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

//coba
Route::post('/studio/add', [StudioController::class, 'addStudio']);
Route::post('/studio/update/{id}', [StudioController::class, 'updateStudio']);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1')->name('password.email');
Route::post('/password/reset',  [AuthController::class, 'resetPassword'])->name('password.reset');


//list studio
Route::get('/studio', [StudioController::class, 'index']);
Route::get('/studio/{id}', [StudioController::class, 'detailStudio']);
Route::get('/studio/status/{studio_status}', [StudioController::class, 'filterByStatus']);
Route::get('/studio/day/{studio_available_day}', [StudioController::class, 'filterByDay']);
Route::get('/studio/name/{studio_name}', [StudioController::class, 'filterByName']);

//list instrument
Route::get('/instrument', [InstrumentController::class, 'index']);
Route::get('/instrument/{id}', [InstrumentController::class, 'detailInstrument']);
Route::get('/instrument/status/{instrument_status}', [InstrumentController::class, 'filterByStatus']);
Route::get('/instrument/name/{instrument_name}', [InstrumentController::class, 'filterByName']);
Route::get('/instrument/category/{instrument_brand}', [InstrumentController::class, 'filterByCategory']);

//list blog
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'detailBlog']);
Route::get('/blog/category/{category}', [BlogController::class, 'filterByCategory']);
Route::get('/blog/title/{title_blog}', [blogController::class, 'filterByTitle']);

//total
Route::get('/total/user', [UserController::class, 'TotalUser']);
Route::get('/total/studio', [StudioController::class, 'TotalStudio']);
Route::get('/total/instrument', [InstrumentController::class, 'TotalInstrument']);
Route::get('/total/blog', [BlogController::class, 'TotalBlog']);



// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    

    /*------------------------------ADMIN ACCESS--------------------------------------*/
    //user table
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('admin');
    Route::get('/userAll', [UserController::class, 'userAll'])->middleware('admin');
    //studio table
    Route::post('/studio', [StudioController::class, 'store'])->middleware('admin');
    Route::put('/studio/{id}', [StudioController::class, 'update'])->middleware('admin');
    Route::delete('/studio/{id}', [StudioController::class, 'destroy'])->middleware('admin');
    //booking studio table
    Route::put('/booking/studio/approved/{id}', [BookingStudioController::class, 'AcceptBookingStudio'])->middleware('admin');
    Route::delete('/booking/studio/delete/{id}', [BookingStudioController::class, 'deleteBookingStudio'])->middleware('admin');
    Route::get('/booking/studio/all', [BookingStudioController::class, 'allBookingStudio'])->middleware('admin');
    //instrument table
    Route::post('/instrument', [InstrumentController::class, 'store'])->middleware('admin');
    Route::put('/instrument/{id}', [InstrumentController::class, 'update'])->middleware('admin');
    Route::delete('/instrument/{id}', [InstrumentController::class, 'destroy'])->middleware('admin');
    //booking instrument table
    Route::put('/booking/instrument/approved/{id}', [BookingAlatController::class, 'AcceptBookingInstrument'])->middleware('admin');
    Route::delete('/booking/instrument/delete/{id}', [BookingAlatController::class, 'deleteBookingInstrument'])->middleware('admin');
    Route::get('/booking/instrument/all', [BookingAlatController::class, 'allBookingInstrument'])->middleware('admin');
    //Blog table
    Route::post('/blog/post', [BlogController::class, 'store'])->middleware('admin');
    Route::put('/blog/{id}', [BlogController::class, 'update'])->middleware('admin');
    Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->middleware('admin');

/*------------------------------USER ACCESS--------------------------------------*/
    //user table
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
 
    //Booking Studio table
    Route::post('/booking/studio/add', [BookingStudioController::class, 'createBookingStudio']);
    Route::get('/mystudio/{user_id}', [BookingStudioController::class, 'MyBookingStudio']);
    Route::put('/booking/studio/cancel/{id}', [BookingStudioController::class, 'cancelBookingStudio']);
    //Booking Instrument table
    Route::post('/booking/instrument/add', [BookingAlatController::class, 'createBookingInstrument']);
    Route::get('/myinstrument/{user_id}', [BookingAlatController::class, 'MyBookingInstrument']);
    Route::put('/booking/instrument/cancel/{id}', [BookingAlatController::class, 'cancelBookingInstrument']);
       
    //ADMIN DAN USER
    Route::post('/logout', [AuthController::class, 'logout']);
    
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
