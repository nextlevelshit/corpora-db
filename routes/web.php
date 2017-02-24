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
Route::get('/', function () {
    return redirect(route('entry.index'));
});
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
Route::resource('entry', 'EntryController');
/*
|--------------------------------------------------------------------------
| Author Details and Forms
|--------------------------------------------------------------------------
|
| Display details of entry and show editing and adding options.
|
*/
Route::get('author/{numId}', 'AuthorController@details')->name('author.details');
/*
|--------------------------------------------------------------------------
| Texts Upload
|--------------------------------------------------------------------------
|
| Display details of entry and show editing and adding options.
|
*/
Route::resource('entry.text', 'TextController', ['except' => [
    'update', 'destroy', 'edit'
]]);
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
