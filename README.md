# Backend API untuk Parking-u
berikut ini ada beberapa endpoint yang dibuat untuk aplikasi parking-u "


## Routes

```

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {

    //admin
    Route::post('/parkir', [ParkirController::class, 'store']);
    Route::put('/parkir/{id}', [ParkirController::class, 'update']);
    Route::delete('/parkir/{id}', [ParkirController::class, 'destroy']);
    Route::put('/accept/{id}', [BookingController::class, 'updateBooking']);
    Route::get('/riwayat/all', [BookingController::class, 'semuaRiwayat']);
    
    //user
    Route::get('/parkir', [ParkirController::class, 'index']);
    Route::get('/parkir/{id}', [ParkirController::class, 'show']);
    Route::get('/parkir/search/{nama_parkir}', [ParkirController::class, 'search']);
    Route::get('/user', [UserController::class, 'index']);//belum bisa
    Route::get('/user/{id}', [UserController::class, 'show']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::get('/booking', [BookingController::class, 'getVA']);
    Route::post('/booking/add', [BookingController::class, 'createBooking']);
    Route::get('/riwayat/{email}', [BookingController::class, 'riwayat']);
    Route::delete('/booking/{id}', [BookingController::class, 'cancelBooking']);
    
    //admin+user
    Route::post('/logout', [AuthController::class, 'logout']);

