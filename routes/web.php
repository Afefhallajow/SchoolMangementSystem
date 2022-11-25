<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [  'auth']
    ], function () {


    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::resource('Grades', 'App\Http\Controllers\GradeController');
    Route::resource('Teachers', 'App\Http\Controllers\TeacherController');


    Route::resource('Sections', 'App\Http\Controllers\SectionController');
    Route::resource('Students', 'App\Http\Controllers\StudentController');

    Route::get('/classes/{id}', 'App\Http\Controllers\SectionController@getclasses');

    Route::get('/', function (){
        return view('dashboard');
    });
    Route::get('/dashboard', function (){
        return view('dashboard');
    });

    Route::get('/tes', [App\Http\Controllers\HomeController::class, 'tes']);

    Route::get('/dash', [App\Http\Controllers\HomeController::class, 'afef']);
    //Route::resource('grade', 'GradeController');
    Route::resource('Classrooms', 'App\Http\Controllers\ClassroomController');


    Route::post('delete_all', 'App\Http\Controllers\ClassroomController@delete_all')->name('delete_all');

    Route::post('Filter_Classes', 'App\Http\Controllers\ClassroomController@Filter_Classes')->name('Filter_Classes');

    //==============================parents============================

    Route::view('add_parent','livewire.show_Form');

    Route::get('/Get_classrooms/{id}', 'App\Http\Controllers\StudentController@Get_classrooms');
    Route::get('/Get_Sections/{id}', 'App\Http\Controllers\StudentController@Get_Sections');


});

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


