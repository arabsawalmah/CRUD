<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::resource('dataevent', EventController::class); 

Route::get('/', function () { 
    return view('welcome'); 
}); 

Auth::routes(); 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/event', [EventController::class, 'index'])->name('event.index');
Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
Route::post('/event/store', [EventController::class, 'store'])->name('event.store');