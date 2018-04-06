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
    Route::get('/','DashBoardController@dashboard')->name('dashboard');
    Route::get('/logout','DashBoardController@logout')->name('logout');
    Route::post('/boardpersonal','DashBoardController@boardpersonal')->name('postboard');
    Route::post('/creategroup','DashBoardController@boardgroup')->name('postgroup');

    Route::get('project-detail/{id}','ProjectsController@index')->middleware('checkproject');
    Route::post('createboard','ProjectsController@createBoard')->name('createboard');

    Route::post('/createprojectgroup','DashBoardController@board_group_project')->name('createprojectgroup');

    Route::post('updateboard','ProjectsController@updateBoard')->name('updateboard');

    Route::post('detailTask','TasksController@detailTask')->name('detailtask');
    Route::post('createTask','TasksController@createTask')->name('createtask');
    Route::post('deleteTask','TasksController@deleteTask')->name('deletetask');


    Route::delete('/deletepersonal/{id}','DashBoardController@delete_board_personal')->name('deletepersonal');

    Route::get('/getboardpersonal/{id}','DashBoardController@get_board_personal')->name('getboardpersonal');

    Route::put('/editboardpersonal/{id}','DashBoardController@edit_board_personal');



    Route::delete('/delprojectgroup/{id}','DashBoardController@del_project_group');

    Route::get('/getgroup/{id}','DashBoardController@get_group_edit');

    Route::post('/editgroup/{id}','DashBoardController@edit_group');

    Route::delete('/delgroup/{id}','DashBoardController@delete_group');
});