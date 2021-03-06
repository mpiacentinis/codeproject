<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

use Illuminate\Support\Facades\Response;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

Route::get('/', function() {
    return view('app');
});

Route::post('oauth/access_token', function()
{
    return Response::json( Authorizer::issueAccessToken());
});


Route::group(['middleware' => 'oauth' ], function () {


    //Route::get('/', 'ClientController@index');

    Route::group(['prefix' => 'clients'], function () {
        Route::get('',                  ['as' => 'clients.index',           'uses' => 'ClientController@index']);
        Route::post('',                 ['as' => 'clients.store',           'uses' => 'ClientController@store']);
        Route::get('/{id}',             ['as' => 'clients.show',            'uses' => 'ClientController@show']);
        Route::delete('/{id}',          ['as' => 'clients.delete',          'uses' => 'ClientController@destroy']);
        Route::put('/{id}',             ['as' => 'clients.update',          'uses' => 'ClientController@update']);

    });

    Route::group(['prefix' => 'project'], function () {

        Route::get('/{id}/note',            ['as' => 'projectNote.index',           'uses' => 'ProjectNoteController@index']);
        Route::post('/{id}/note',           ['as' => 'projectNote.store',           'uses' => 'ProjectNoteController@store']);
        Route::get('/{id}/note/{noteId}',   ['as' => 'projectNote.show',            'uses' => 'ProjectNoteController@show']);
        Route::put('/{id}/note/{noteId}',   ['as' => 'projectNote.update',          'uses' => 'ProjectNoteController@update']);
        Route::delete('/{id}/note/{noteId}', ['as' => 'projectNote.delete',          'uses' => 'ProjectNoteController@destroy']);

        Route::get('/{id}/task',            ['as' => 'projectTask.index',           'uses' => 'ProjectTaskController@index']);
        Route::post('/{id}/task',           ['as' => 'projectTask.store',           'uses' => 'ProjectTaskController@store']);
        Route::get('/{id}/task/{taskId}',   ['as' => 'projectTask.show',            'uses' => 'ProjectTaskController@show']);
        Route::put('/{id}/task/{taskId}',   ['as' => 'projectTask.update',          'uses' => 'ProjectTaskController@update']);
        Route::delete('/{id}/task/{taskId}',['as' => 'projectTask.delete',          'uses' => 'ProjectTaskController@destroy']);

        Route::get('/{id}/member',              ['as' => 'projectMember.index',           'uses' => 'ProjectMemberController@index']);
        Route::post('/{id}/member',             ['as' => 'projectMember.store',           'uses' => 'ProjectMemberController@store']);
        Route::get('/{id}/member/{memberId}',   ['as' => 'projectMember.show',            'uses' => 'ProjectMemberController@show']);
        Route::put('/{id}/member/{memberId}',   ['as' => 'projectMember.update',          'uses' => 'ProjectMemberController@update']);
        Route::delete('/{id}/member/{memberId}',['as' => 'projectMember.delete',          'uses' => 'ProjectMemberController@destroy']);


        Route::get('/{id}/members',               ['as' => 'projectMembers.show',         'uses' => 'ProjectController@showMembers']);
        Route::get('/{id}/members/{memberId}',    ['as' => 'projectMembers.isMember',     'uses' => 'ProjectController@isMember']);
        Route::delete('/{id}/members/{memberId}', ['as' => 'projectMembers.delete',       'uses' => 'ProjectController@removeMember']);

        Route::post('/{id}/file',                    ['as' => 'projectFile.upload',        'uses' => 'ProjectFileController@store']);
        Route::get('/{id}/file',                     ['as' => 'projectFile.show',           'uses' => 'ProjectFileController@index']);
        Route::get('/{id}/file/{fileId}',            ['as' => 'projectFile.get',           'uses' => 'ProjectFileController@show']);
        Route::delete('/{id}/file/{fileId}',         ['as' => 'projectFile.delete',        'uses' => 'ProjectFileController@destroy']);

        Route::get('',                  ['as' => 'project.index',           'uses' => 'ProjectController@index']);
        Route::post('',                 ['as' => 'project.store',           'uses' => 'ProjectController@store']);
        Route::get('/{id}',             ['as' => 'project.show',            'uses' => 'ProjectController@show']);
        Route::delete('/{id}',          ['as' => 'project.delete',          'uses' => 'ProjectController@destroy']);
        Route::put('/{id}',             ['as' => 'project.update',          'uses' => 'ProjectController@update']);

    });

});
