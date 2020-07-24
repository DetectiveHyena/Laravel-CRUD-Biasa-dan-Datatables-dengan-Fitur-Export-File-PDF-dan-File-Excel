<?php

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

/*Route::get('/', function () {
return view('tampil');
});
 
Route::resource('ajax-crud', 'AjaxCrudController');
Route::post('ajax-crud/update', 'AjaxCrudController@update')->name('ajax-crud.update');
Route::get('ajax-crud/destroy/{id}', 'AjaxCrudController@destroy');
*/

Route::resource('datatables', 'DatatablesController');
Route::get('datatables', 'DatatablesController@index')->name('datatables.kpops');
Route::post('datatables/update', 'DatatablesController@update')->name('datatables.update');
Route::get('datatables/destroy/{id}', 'DatatablesController@destroy');


Route::resource('kpops', 'KpopController');
Route::get('/', 'KpopController@index')->name('kpops.index');
Route::get('/lookfor', 'KpopController@lookfor')->name('kpops.lookfor');
Route::get('/printpdf', 'KpopController@printpdf')->name('kpops.printpdf');
Route::get('/export', 'KpopController@export');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
