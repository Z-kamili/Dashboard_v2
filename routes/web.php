<?php

use App\Http\Controllers\Category\CategoryController;
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

Route::group(
     [
     'prefix'   => 'Admin',
     'middleware' => 'auth'
     ],
     function(){


      //dashboard
      Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

      //categories
      Route::resource('category','App\Http\Controllers\category\CategoryController');

      //articles 
      Route::resource('articles','App\Http\Controllers\article\ArticleController');

      //calendar
      Route::resource('calendar','App\Http\Controllers\calendar\CalendarController');



    });




require __DIR__.'/auth.php';
