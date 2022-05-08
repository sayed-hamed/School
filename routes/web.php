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



Auth::routes();

Route::group(['middleware'=>['guest']],function (){

    Route::get('/',function (){

        return view('auth.login');

    });


});





Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');

    //=============Grad========//
    Route::resource('grad','GradController');

    //============Classroom=====//

    Route::resource('classroom','ClassController');
    Route::post('delete_all', 'ClassController@delete_all')->name('delete_all');

    Route::post('Filter_Classes', 'ClassController@Filter_Classes')->name('Filter_Classes');

    //===========sections========//

    Route::resource('section','SectionController');
    Route::get('classes/{id}','SectionController@getclasses')->name('sec-class');


});






