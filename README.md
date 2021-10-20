# Backend API Syncphonic
berikut ini ada beberapa endpoint yang dibuat untuk aplikasi syncphonic"


## Routes

```

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

