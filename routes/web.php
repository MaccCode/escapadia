<?php

use App\Http\Controllers\Home;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ListerController;

Route::get('/', function () {
    return view('home.index');
});

route::get('/',[ListerController::class,'home']);

Route::get('/home',[ListerController::class,'index'])->name('home');

Route::get('/dashboard',[ListerController::class,'dashboard'])->name('dashboard');


// Get routes home
route::get('/view_bookings',[Home::class,'view_bookings']);
route::get('/property_details/{id}',[Home::class,'property_details']);
Route::get('/booking_delete/{id}', [Home::class, 'booking_delete']);
route::get('/display',[Home::class,'display']);
route::get('/beach',[Home::class,'beach']);
route::get('/lake',[Home::class,'lake']);
route::get('/pool',[Home::class,'pool']);
route::get('/private',[Home::class,'private']);
route::get('/nature',[Home::class,'nature']);
route::get('/camp',[Home::class,'camp']);

// Post routes home
route::post('/add_booking/{id}',[Home::class,'add_booking']);
route::post('/approve_booking/{id}',[Home::class,'approve_booking']);
route::post('/reject_booking/{id}',[Home::class,'reject_booking']);
route::post('/payment/{id}',[Home::class,'payment']);


// Post routes Lister
route::post('/add_listing',[ListerController::class,'add_listing']);
route::post('/listing_update_confirm/{id}',[ListerController::class,'listing_update_confirm']);
route::post('/checkin/{id}',[ListerController::class,'checkin']);
route::post('/checkout/{id}',[ListerController::class,'checkout']);
route::post('/complete/{id}',[ListerController::class,'complete']);
route::post('/save_complete/{id}',[ListerController::class,'save_complete'])->name('save_complete');
route::post('/apply_confirm',[ListerController::class,'apply_confirm']);
route::post('/make_lister/{id}',[ListerController::class,'make_lister']);
route::post('/make_admin/{id}',[ListerController::class,'make_admin']);
route::post('/make_user/{id}',[ListerController::class,'make_user']);
route::post('/approve_application/{id}',[ListerController::class,'approve_application']);
Route::post('/add_image', [ListerController::class, 'add_image'])->name('add_image');


// Get routes Lister
route::get('/create_listing',[ListerController::class,'create_listing']);
Route::get('/view_listing', [ListerController::class, 'view_listing'])->name('Dashboard.view_listing');
route::get('/messages',[ListerController::class,'messages']);
Route::get('/listing_delete/{id}', [ListerController::class, 'listing_delete']);
Route::get('/delete_booking/{id}', [ListerController::class, 'delete_booking']);
Route::get('/cancel_booking/{id}', [ListerController::class, 'cancel_booking']);
Route::get('/listing_update/{id}', [ListerController::class, 'listing_update']);
Route::get('/save_complete/{id}', [ListerController::class, 'save_complete']);
Route::get('/view_complete',[ListerController::class,'view_complete']);
route::get('/apply',[ListerController::class,'apply']);
route::get('/application_update',[ListerController::class,'application_update']);
route::get('/users',[ListerController::class,'user'])->name('users');
Route::get('/gallery_view', [ListerController::class, 'gallery_view'])->name('gallery_view');
Route::get('/image_delete/{id}', [ListerController::class, 'image_delete']);

