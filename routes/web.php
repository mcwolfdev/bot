<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


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

Route::get('/login', function () {
    return view('/auth/login');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home&need_approve', [App\Http\Controllers\HomeController::class, 'approveShow'])->name('show.only.approve');
Route::get('/home&approve{keyap}', [App\Http\Controllers\HomeController::class, 'approve'])->name('approve');
Route::post('/home/create',[App\Http\Controllers\HomeController::class, 'create'])->name('create');
//Route::get('/home/create',[App\Http\Controllers\HomeController::class, 'create'])->name('create');


Route::get('/home/del={keydel}', function ($keydel) {
    return HomeController::delete($keydel);
})->name('delete');


/*Route::get('home/{text}', function ($messsend, $teleid) {
    return HomeController::messagesend($messsend, $teleid);
})->name('post.mess');*/

Route::post('/home/edit&{keyed}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');


