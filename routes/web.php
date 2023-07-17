<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MovieListController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\WatchLaterController;
use Illuminate\Support\Facades\Route;

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

// Home
Route::get('/', [HomeController::class, "index"]);

// Login Routes
Route::get('/login', [LoginController::class, "index"])->middleware("guest");
Route::post("/login", [LoginController::class, "authenticate"])->middleware("guest");
Route::post("/logout", [LoginController::class, "logout"])->middleware("auth");

// Register Routes
Route::get('/register', [RegisterController::class, "index"])->middleware("guest");
Route::post("/register", [RegisterController::class, "register"])->middleware("guest");

// Movie Routes
Route::get("/movie", [MovieListController::class, "index"]);
Route::get("/movie/{movie:slug}", [MovieListController::class, "show"]);


// Comment Routes
Route::post("/comment", [CommentController::class, "comment"])->middleware("auth");
Route::delete("/comment", [CommentController::class, "delete"]);

Route::get("/genre/{genre:slug}", [GenreController::class, "index"]);

// Watch Later Routes
Route::post("/watchlater", [WatchLaterController::class, "watchLater"])->middleware("auth");
Route::get("/watchlater", [WatchLaterController::class, "index"])->middleware("auth");
