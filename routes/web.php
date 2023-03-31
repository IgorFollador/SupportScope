<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Voyager;
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

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    Route::resource('/websites', 'App\Http\Controllers\Voyager\WebsiteController');
    Route::get('/websites/{id}', 'App\Http\Controllers\Voyager\WebsiteController@index')->name('voyager.websites.index');
    Route::get('/websites/{id}', 'App\Http\Controllers\Voyager\WebsiteController@show')->name('voyager.websites.show');
    Route::get('/admin/websites/create', 'Voyager\WebsiteController@create')->name('voyager.websites.create');
});
