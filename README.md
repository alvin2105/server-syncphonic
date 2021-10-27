# Backend API Syncphonic

berikut ini ada beberapa endpoint yang dibuat untuk aplikasi syncphonic"

## Routes

```

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/forgot', [UserController::class, 'forgot']);
Route::post('/reset', [UserController::class, 'reset']);

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
    Route::get('/mystudio/{name}', [BookingStudioController::class, 'MyBookingStudio']);
    Route::put('/booking/studio/cancel/{id}', [BookingStudioController::class, 'cancelBookingStudio']);
    //Booking Instrument table
    Route::post('/booking/instrument/add', [BookingAlatController::class, 'createBookingInstrument']);
    Route::get('/myinstrument/{name}', [BookingAlatController::class, 'MyBookingInstrument']);
    Route::put('/booking/instrument/cancel/{id}', [BookingAlatController::class, 'cancelBookingInstrument']);

    //ADMIN DAN USER
    Route::post('/logout', [AuthController::class, 'logout']);

});
```
