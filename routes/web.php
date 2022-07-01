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




Route::get('/', 'HomeController@index')->name('selection');

Route::group(['namespace'=>'Auth'],function (){
   Route::get('login/{type}','LoginController@showform')->name('login.show');
   Route::post('/login','LoginController@login')->name('login');
   Route::get('/logout/{type}','LoginController@logout')->name('logout');
});






Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

//    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/dashboard', 'HomeController@dashoard')->name('dashboard');

    //=============Grad========//
    Route::resource('grad','GradController');

    //============Classroom=====//

    Route::resource('classroom','ClassController');
    Route::post('delete_all', 'ClassController@delete_all')->name('delete_all');

    Route::post('Filter_Classes', 'ClassController@Filter_Classes')->name('Filter_Classes');

    //===========sections========//

    Route::resource('section','SectionController');
    Route::get('classes/{id}','SectionController@getclasses')->name('sec-class');

    Route::view('add-parent','livewire.show_form')->name('add-parent');

    //===========Teachers==============//

     Route::resource('teachers','TeacherController');


    //===========students==============//

    Route::resource('students','StudentController');
    Route::get('Get_classrooms/{id}','StudentController@Get_classrooms');
    Route::get('Get_Sections/{id}','StudentController@Get_Sections');
    Route::post('student_attach','StudentController@upload_attach')->name('upload_attach');
    Route::get('dawnload_attachment/{stdname}/{filename}','StudentController@dawnload_attachment')->name('dawnload_attachment');
    Route::post('delete_attach','StudentController@delete_attach')->name('delete_attach');
    Route::resource('promotion','PromotionController');
    Route::resource('graduated','GraduatedController');
    Route::resource('fee','FeesController');
    Route::resource('fee_invoices','InvoicesFeesController');
    Route::resource('attandence','AttandenceController');
    Route::resource('subject','SubjectController');
    Route::resource('exam','QuizController');
    Route::resource('question','QuestionController');
    Route::resource('meetings','OnlineMeetingController');
    Route::get('indirect','OnlineMeetingController@indirect')->name('indirect.create');
    Route::post('indirect','OnlineMeetingController@indirectstore')->name('indirect.store');
    Route::resource('library','LibraryController');
    Route::get('dawnload/{fn}','LibraryController@dawnload_book')->name('dawnload_book');
    Route::resource('setting','SettingController');


});






