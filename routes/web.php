<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Frontend\PageController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

/************** */
//frontend
/************** */

Route::get('/',[PageController::class,'index'])->name('index');
Route::get('/profile/{user}', [PageController::class,'userProfile']);

Route::get('sellers/{category}',[PageController::class,'categorySellers']);








/************** */
//backend
/************** */

Route::get('/dashboard', [UsersController::class,'profile'])->name('dashboard');
Route::get('/update/profile/{user}', [UsersController::class,'updateProfile']);
Route::post('update/profile', [UsersController::class,'profileUpdate']);
Route::post('add/user/description', [UsersController::class,'addDescription']);
Route::post('update/user/description', [UsersController::class,'updateDescription']);
Route::post('add/skills', [UsersController::class,'addSkills']);
Route::post('add/portfolio', [UsersController::class,'addPortfolio']);


Route::get('categories',[CategoryController::class,'index'])->name('category')->middleware(['auth']);
Route::post('category/store',[CategoryController::class,'store'])->name('category.store')->middleware(['auth']);

Route::get('all/users',[UsersController::class,'allUsers'])->name('users');


require __DIR__.'/auth.php';
