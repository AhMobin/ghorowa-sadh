<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\UsersController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::get('categories',[CategoryController::class,'index'])->name('category')->middleware(['auth']);
Route::post('category/store',[CategoryController::class,'store'])->name('category.store')->middleware(['auth']);



Route::get('all/users',[UsersController::class,'index'])->name('users');
require __DIR__.'/auth.php';
