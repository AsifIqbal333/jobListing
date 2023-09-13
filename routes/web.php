<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*
|--------------------------------------------------------------------------
| Listing Routes
|--------------------------------------------------------------------------
*/


// All listings
Route::get('/', [ListingController::class, 'index']);

//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create')->middleware('auth');

//Store Listing
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store')->middleware('auth');

//Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit')->middleware('auth');

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update')->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy')->middleware('auth');

//show Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/

//Show Register/create form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');

//Create User
Route::post('/users', [UserController::class, 'store'])->name('users.store');

//User logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login', [UserController::class,'login'])->name('login')->middleware('auth');

//Log In User
Route::post('/users/authenticate', [UserController::class,'authenticate']);

