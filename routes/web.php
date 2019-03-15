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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', function () {
    return view('layout');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('login','Backend\LoginController@getLogin');
    Route::post('login','Backend\LoginController@postLogin');
    Route::get('logout','Backend\LoginController@logout');
    //Route::get('/dashboard/{param?}', 'Backend\DashboardController@dashboard');
    Route::get('/dashboard', 'Backend\DashboardController@dashboard');
    Route::get('/member', 'Backend\MembersController@index');
    Route::get('/member/update', 'Backend\MembersController@update');
    Route::get('/member/del/{id}', 'Backend\MembersController@destroy');
    Route::get('/member/process_update', 'Backend\MembersController@process_update');
    Route::resource('member_action', 'Backend\MembersController');

    Route::resource('language_action', 'Backend\LanguagesController');
    Route::get('/language', 'Backend\LanguagesController@index');
    Route::get('/language/update', 'Backend\LanguagesController@update');
    Route::get('/language/del/{id}', 'Backend\LanguagesController@destroy');
    Route::get('/language/process_update', 'Backend\LanguagesController@process_update');

    Route::resource('question_action', 'Backend\QuestionsController');
    Route::get('/question', 'Backend\QuestionsController@index');
    Route::get('/question/create', 'Backend\QuestionsController@create');
    Route::get('/question/update/{id}', 'Backend\QuestionsController@update');
    Route::get('/question/del/{id}', 'Backend\QuestionsController@destroy');
    Route::get('/question/process_update', 'Backend\QuestionsController@process_update');
    Route::get('/question/refer_language', 'Backend\QuestionsController@refer_language');


    Route::resource('answer_action', 'Backend\AnswersController');
    Route::get('/answer', 'Backend\AnswersController@index');
    Route::get('/answer/create/{id}', 'Backend\AnswersController@create');
    //Route::get('/answer/refer_question', 'Backend\AnswersController@refer_question');
    Route::get('/answer/del/{id}', 'Backend\AnswersController@destroy');
    Route::get('/answer/process_update', 'Backend\AnswersController@process_update');

    Route::resource('assign_action', 'Backend\AssignsController');
    Route::post('/assign/del_row', 'Backend\AssignsController@del_row');
    Route::get('/assign/send_email/{member_id}/{language_id}', 'Backend\AssignsController@send_email');
    //Route::get('/assign', 'Backend\AssignsController@index');
    //Route::get('/assign/creates/{id}', 'Backend\AssignsController@create');
    //Route::post('/assign/create', 'Backend\AssignsController@create');
    //tv
    /*Route::get('/assign/update/{assign_id}/{member_id}/{language_id}', 'Backend\AssignsController@update');
    Route::post('/assign/process_update', 'Backend\AssignsController@process_update');*/
});

Route::group(['prefix' => 'home'], function () {
    Route::get('/','Frontend\HomesController@index');
    Route::get('/exercise','Frontend\HomesController@exercise');
    Route::resource('home_action', 'Frontend\HomesController');

});


