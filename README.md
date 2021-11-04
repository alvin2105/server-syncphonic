# Backend API Syncphonic

berikut ini ada beberapa endpoint yang dibuat untuk aplikasi syncphonic"

## Link Dokumentasi📙

https://documenter.getpostman.com/view/9474608/UV5ZBbq2

## Routes

### Public Routes

#### Authentication 👮‍♂️

```
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1')->name('password.email');
Route::post('/password/reset',  [AuthController::class, 'resetPassword'])->name('password.reset');
```

#### List Studio 🎶

```
Route::get('/studio', [StudioController::class, 'index']);
Route::get('/studio/{id}', [StudioController::class, 'detailStudio']);
Route::get('/studio/status/{studio_status}', [StudioController::class, 'filterByStatus']);
Route::get('/studio/day/{studio_available_day}', [StudioController::class, 'filterByDay']);
Route::get('/studio/name/{studio_name}', [StudioController::class, 'filterByName']);
```

#### List Instrument 🎻

```
Route::get('/instrument', [InstrumentController::class, 'index']);
Route::get('/instrument/{id}', [InstrumentController::class, 'detailInstrument']);
Route::get('/instrument/status/{instrument_status}', [InstrumentController::class, 'filterByStatus']);
Route::get('/instrument/name/{instrument_name}', [InstrumentController::class, 'filterByName']);
Route::get('/instrument/category/{instrument_brand}', [InstrumentController::class, 'filterByCategory']);
```

#### List Blog 📙

```
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{id}', [BlogController::class, 'detailBlog']);
Route::get('/blog/category/{category}', [BlogController::class, 'filterByCategory']);
Route::get('/blog/title/{title_blog}', [blogController::class, 'filterByTitle']);
```

### Protected routes

### ADMIN Access

##### User Table 👮‍♂️

```
Route::delete('/user/{id}', [UserController::class, 'destroy'])->middleware('admin');
Route::get('/userAll', [UserController::class, 'userAll'])->middleware('admin');
```

##### Studio Table 🎶

```
Route::post('/studio', [StudioController::class, 'store'])->middleware('admin');
Route::put('/studio/{id}', [StudioController::class, 'update'])->middleware('admin');
Route::delete('/studio/{id}', [StudioController::class, 'destroy'])->middleware('admin');
```

##### Booking Studio Table 🎶

```
Route::put('/booking/studio/approved/{id}', [BookingStudioController::class, 'AcceptBookingStudio'])->middleware('admin');
Route::delete('/booking/studio/delete/{id}', [BookingStudioController::class, 'deleteBookingStudio'])->middleware('admin');
Route::get('/booking/studio/all', [BookingStudioController::class, 'allBookingStudio'])->middleware('admin');
```

##### Instrument Table 🎻

```
Route::post('/instrument', [InstrumentController::class, 'store'])->middleware('admin');
Route::put('/instrument/{id}', [InstrumentController::class, 'update'])->middleware('admin');
Route::delete('/instrument/{id}', [InstrumentController::class, 'destroy'])->middleware('admin');
```

##### Booking Instrument Table 🎻

```
Route::put('/booking/instrument/approved/{id}', [BookingAlatController::class, 'AcceptBookingInstrument'])->middleware('admin');
Route::delete('/booking/instrument/delete/{id}', [BookingAlatController::class, 'deleteBookingInstrument'])->middleware('admin');
Route::get('/booking/instrument/all', [BookingAlatController::class, 'allBookingInstrument'])->middleware('admin');
```

##### Blog Table 📙

```
Route::post('/blog/post', [BlogController::class, 'store'])->middleware('admin');
Route::put('/blog/{id}', [BlogController::class, 'update'])->middleware('admin');
Route::delete('/blog/{id}', [BlogController::class, 'destroy'])->middleware('admin');
```

### USER Access

##### User Table 👮‍♂️

```
Route::get('/user/{id}', [UserController::class, 'show']);
Route::put('/user/{id}', [UserController::class, 'update']);
```

##### Booking Studio Table 🎶

```
Route::post('/booking/studio/add', [BookingStudioController::class, 'createBookingStudio']);
Route::get('/mystudio/{name}', [BookingStudioController::class, 'MyBookingStudio']);
Route::put('/booking/studio/cancel/{id}', [BookingStudioController::class, 'cancelBookingStudio']);
```

##### Booking Instrument Table 🎻

```
Route::post('/booking/instrument/add', [BookingAlatController::class, 'createBookingInstrument']);
Route::get('/myinstrument/{name}', [BookingAlatController::class, 'MyBookingInstrument']);
Route::put('/booking/instrument/cancel/{id}', [BookingAlatController::class, 'cancelBookingInstrument']);
```

### ADMIN DAN USER 👮‍♂️

```
Route::post('/logout', [AuthController::class, 'logout']);
```
