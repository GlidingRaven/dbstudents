<?php

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

Route::get('/', 'ListController@index');


Route::get('/citys', 'ListController@citys');
Route::get('/campuses', 'ListController@campuses');


Route::get('/ci/{post}', 'ListController@city');
Route::get('/uz/{post}', 'ListController@campuse');
Route::get('/or/{post}', 'ListController@order');

Route::get('/finder', 'FindController@finder');

Route::get('/admin', 'MgrController@index')->middleware('auth');
Route::post('/newcity', 'MgrController@newcity')->middleware('auth');
Route::post('/newcampuse', 'MgrController@newcampuse')->middleware('auth');
Route::post('/newsource', 'MgrController@newsource')->middleware('auth');
Route::post('/newregex', 'MgrController@newregex')->middleware('auth');
Route::post('/delsource', 'MgrController@delsource')->middleware('auth');

Route::get('/history', 'MgrController@index');

Route::get('/faq', 'ListController@faq');
Route::get('/site', 'ListController@site');


Route::get('/kolos', 'HomeController@index');
Route::post('/kolos', 'HomeController@index');

//Route::post('/posts/{post}/comment', 'ListController@comment')->middleware('auth');
Auth::routes();