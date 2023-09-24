<?php
use App\Http\Controllers\AdminCategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RouteController;
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

Route::get('/', [RouteController::class, "main"]);

Auth::routes();

Route::get('/item/{id}', [RouteController::class, "routePage"]);

Route::get('/admin/items/create', 'App\Http\Controllers\AdminItemController@create')->name('admin.items.create');
Route::post('/admin/items/store', 'App\Http\Controllers\AdminItemController@store')->name('admin.items.store');
Route::post('/admin/create/category', 'App\Http\Controllers\AdminItemController@category')->name('admin.items.category');
Route::get('/get-subcategories/{category}', [App\Http\Controllers\AdminCategoryController::class, 'getSubcategories']);
Route::post('/admin/category/delete', [App\Http\Controllers\AdminCategoryController::class, 'delete'])->name('admin.category.delete');
Route::get('/item/bucket/{id}', [App\Http\Controllers\BuckerController::class, 'add'])->name('item.bucket.add');
Route::get('/bucket', [App\Http\Controllers\BuckerController::class, "bucket"]);
Route::get('/bucket/delete/{id}', [App\Http\Controllers\BuckerController::class, "delete"]);

