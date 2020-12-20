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
Route::get('search',[PageController::class,'search']);

Route::get('/',[PageController::class,'index'])->name('index');
Route::get('all/categories',[PageController::class,'categories'])->name('all.category');
Route::get('/profile/{user}', [PageController::class,'userProfile']);

Route::get('all/sellers/{category}',[PageController::class,'categorySellers']);

Route::get('message/to/seller/',[PageController::class,'messageToSeller']);

Route::post('hire/{seller}',[PageController::class,'hireASeller']);
Route::get('approve/{id}',[PageController::class,'approvedBuyerRequest'])->middleware(['auth']);
Route::get('deny/{id}',[PageController::class,'denyBuyerRequest'])->middleware(['auth']);
Route::get('deliver/{id}',[PageController::class,'orderDeliver'])->middleware(['auth']);
Route::get('cancel/by/seller/{id}',[PageController::class,'orderCancelBySeller'])->middleware(['auth']);
Route::get('cancel/by/buyer/{id}',[PageController::class,'orderCancelByBuyer'])->middleware(['auth']);

/************** */
//backend
/************** */

Route::get('/dashboard', [UsersController::class,'profile'])->name('dashboard');
Route::get('/update/profile/{user}', [UsersController::class,'updateProfile']);
Route::get('update', [UsersController::class,'updateSuperProfile']);
Route::post('update/profile', [UsersController::class,'profileUpdate']);
Route::post('update/admin/profile', [UsersController::class,'adminProfileUpdate']);
Route::post('add/user/description', [UsersController::class,'addDescription']);
Route::post('update/user/description', [UsersController::class,'updateDescription']);
Route::post('add/skills', [UsersController::class,'addSkills']);
Route::post('add/portfolio', [UsersController::class,'addPortfolio']);


Route::get('categories',[CategoryController::class,'index'])->name('category')->middleware(['auth']);
Route::post('category/store',[CategoryController::class,'store'])->name('category.store')->middleware(['auth']);

Route::get('all/users',[UsersController::class,'allUsers'])->name('users');


require __DIR__.'/auth.php';
