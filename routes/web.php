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
    return 'Index';
});
/*
|--------------------------------------------------------------------------
| Search
|--------------------------------------------------------------------------
|
| Display only search formular with filtering options. If already started
| enquiry, load result page.
|
*/
Route::get('search', function () {
   return 'Suche';
});

Route::post('search', function () {
    return 'Suche gestartet';
});
/*
|--------------------------------------------------------------------------
| Details
|--------------------------------------------------------------------------
|
| Display details of entry and show editing and adding options.
|
*/
Route::get('entry/{numId}', function ($entryId) {
    return 'Eintrag anzeigen:' . $entryId;
});

Route::patch('entry/{numId}', function ($entryId) {
    return 'Eintrag bearbeiten:' . $entryId;
});

Route::put('entry', function () {
    return 'Eintrag hinzufügen';
});
/*
|--------------------------------------------------------------------------
| Download
|--------------------------------------------------------------------------
|
| Prepare bundled files for downloading one or more corpora entries
|
*/
Route::get('download/{numId}', function ($entryId) {
    return 'Eintrag' . $entryId . ' herunterladen';
});

Route::post('download', function ($entryId) {
    return 'Mehrere Einträge herunterladen';
});