<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|----------------------------------d----------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::any('jobs/search', 'SearchController@jobsearch');

Route::resource('job', 'UserJobController');
Route::resource('job/{job_id}/cv', 'UserCvController');
Route::get('jobs/job', 'SearchController@jobindex')->name('jobs.search');
Route::get('jobs/cv', 'SearchController@cvindex')->name('jobs.search');

Route::prefix('admin')->group(function () {
	Route::resource('job/{job_id}/cv', 'CvController');
	Route::resource('job', 'JobController');
  	Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('register', 'AdminController@create')->name('admin.register');
  	Route::post('register', 'AdminController@store')->name('admin.register.store');
  	Route::get('login', 'Auth\Admin\LoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\Admin\LoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\Admin\LoginController@logout')->name('admin.auth.logout');
});