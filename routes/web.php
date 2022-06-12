<?php

use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Route;
use WeStacks\TeleBot\TeleBot;
use Illuminate\Http\Request;

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

Route::group(['prefix' => 'bot', 'middleware' => 'web'], function () {
    Route::get('webhook', 'App\Http\Controllers\BotController@index')->name('hook.index');
    Route::get('handle', 'App\Http\Controllers\BotController@handle');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home/create',[App\Http\Controllers\HomeController::class, 'create'])->name('create');


Route::get('/home/del={keydel}', function ($keydel) {
    return HomeController::delete($keydel);
})->name('delete');


Route::get('home/{text}', function ($messsend) {
    return HomeController::messagesend($messsend);
})->name('post.mess');

Route::post('/home/edit&{keyed}', [App\Http\Controllers\HomeController::class, 'edit'])->name('edit');


