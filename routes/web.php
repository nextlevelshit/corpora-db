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

/*
|--------------------------------------------------------------------------
| Index
|--------------------------------------------------------------------------
|
| Display overview of last added and modified corpora entries. Show up
| search formular and display options for adding new entry.
|
*/
Route::get('/', 'DashboardController@showIndex')->name('dashboard');
/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
|
| Display only search formular with filtering options. If already starteed
| enquiry, load result page.
|
*/
Route::get('search', 'SearchController@showIndex')->name('search');

Route::post('search', 'SearchController@showResults');
/*
|--------------------------------------------------------------------------
| Entry Details and Forms
|--------------------------------------------------------------------------
|
| Display details of entry and show editing and adding options.
|
*/
Route::get('entry/{numId}', 'EntryController@showDetails')->name('entry.details');

Route::get('entry', 'EntryController@create')->name('entry.create');

Route::patch('entry/{numId}', 'EntryController@edit');

Route::put('entry', 'EntryController@save');
/*
|--------------------------------------------------------------------------
| Author Details and Forms
|--------------------------------------------------------------------------
|
| Display details of entry and show editing and adding options.
|
*/
Route::get('author/{numId}', 'AuthorController@showDetails')->name('author.details');
/*
|--------------------------------------------------------------------------
| Download
|--------------------------------------------------------------------------
|
| Prepare bundled files for downloading one or more corpora entries
|
*/
Route::get('download/{numId}', 'DownloadController@downloadSingle');

Route::post('download', 'DownloadController@downloadMultiple');
