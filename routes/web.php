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

Route::view('/', 'home')->name('home');

Route::resource('projects', 'ProjectsController');

// Route::get('/projects', 'ProjectsController@index')->name('projects.index');
// Route::get('/projects/create', 'ProjectsController@create')->name('projects.create');
// Route::get('/projects/{project}/edit', 'ProjectsController@edit')->name('projects.edit');
// Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');

// Route::post('/projects', 'ProjectsController@store')->name('projects.store');
// Route::put('/projects/{project}', 'ProjectsController@update')->name('projects.update');
// Route::delete('/projects/{project}', 'ProjectsController@delete')->name('projects.destroy');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::post('contact', 'MessagesController@store')->name('contact.store');

Auth::routes(['register' => false]);
