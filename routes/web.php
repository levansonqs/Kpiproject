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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard','middleware'=>'auth'],function(){
    Route::get('/','DashBoardController@dashboard');
    Route::get('/logout','DashBoardController@logout')->name('logout');
    Route::post('/boardpersonal','DashBoardController@boardpersonal')->name('postboard');
    Route::post('/creategroup','DashBoardController@boardgroup')->name('postgroup');

    Route::get('project_detail/{id}','ProjectsController@index');
    Route::post('createboard','ProjectsController@createBoard')->name('createboard');
    Route::post('/createprojectgroup','DashBoardController@board_group_project')->name('createprojectgroup');

    Route::post('/deletepersonal/{id}','DashBoardController@delete_board_personal')->name('deletepersonal');

    Route::get('/getboardpersonal/{id}','DashBoardController@get_board_personal')->name('getboardpersonal');

    Route::put('/editboardpersonal/{id}','DashBoardController@edit_board_personal');
});