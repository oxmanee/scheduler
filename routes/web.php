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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'ManagePeopleController@viewAdd')->name('viewAdd');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/viewAdd', 'ManagePeopleController@viewAdd')->name('viewAdd');
Route::post('/addDoc', 'ManagePeopleController@addDoc')->name('addDoc');
Route::post('/addPatient', 'ManagePeopleController@addPatient')->name('Patient');

Route::get('/viewEdit', 'ManagePeopleController@viewEdit')->name('viewEdit');
Route::post('/getInfoPatient', 'ManagePeopleController@getInfoPatient')->name('getInfoPatient');
Route::post('/editPatient', 'ManagePeopleController@editPatient')->name('editPatient');
Route::post('/getInfoDoc', 'ManagePeopleController@getInfoDoc')->name('getInfoDoc');
Route::post('/editDoc', 'ManagePeopleController@editDoc')->name('editDoc');
Route::post('/delPatient', 'ManagePeopleController@delPatient')->name('delPatient');
Route::post('/delDoc', 'ManagePeopleController@delDoc')->name('delDoc');

Route::get('/viewSchedule', 'ManageScheduleController@viewSchedule')->name('viewSchedule');
Route::post('/addSchedule', 'ManageScheduleController@addSchedule')->name('addSchedule');
Route::post('/changeDoc', 'ManageScheduleController@changeDoc')->name('changeDoc');
Route::post('/getPatientOfDoc', 'ManageScheduleController@getPatientOfDoc')->name('getPatientOfDoc');
Route::post('/delPatientSchedule', 'ManageScheduleController@delPatientSchedule')->name('delPatientSchedule');


