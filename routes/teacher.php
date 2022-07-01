<?php

use Illuminate\Support\Facades\Auth;
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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher' ]
    ], function() {

    Route::get('/teacher/dashboard', function () {

        $ids=\App\Models\Teacher::findOrFail(\auth()->user()->id)->sections()->pluck('section_id');
        $tsc=$ids->count();

        $stcount=\App\Models\Student::whereIn('section_id',$ids)->count();

        return view('admin.teacher_dashboard',compact('tsc','stcount'));
    })->name('teac-dash');

    Route::group(['namespace' => 'teacher'], function () {

        Route::get('student','StudentController@index')->name('std.index');
        Route::get('section','StudentController@section')->name('sec.index');
        Route::post('attendance','StudentController@attandence')->name('attendance');



    });

});






