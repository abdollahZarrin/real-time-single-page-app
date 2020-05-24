<?php
use Illuminate\Support\Facades\Route;

Route::apiResource('/question','QuestionController');
Route::apiResource('/category','CategoryController');
Route::apiResource('/question/{question}/reply','ReplyController');

Route::post('like/{reply}','LikeController@like');
Route::delete('like/{reply}','LikeController@unLike');
Route::delete('reply/{reply_id}','ReplyController@destroy');
Route::post('reply/{reply_id}/edit','ReplyController@update');
Route::post('notifications','NotificationController@index');
Route::post('markAsRead','NotificationController@markAsRead');
Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});
