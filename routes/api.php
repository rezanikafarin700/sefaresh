<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::namespace('\App\Http\Controllers\API')->group(function (){
    Route::post('/login','AuthController@login');
    Route::post('/logout','AuthController@logout')->middleware('auth:api');
    Route::get('/user','AuthController@user')->middleware('auth:api');
});
Route::get('/test',function (Request $request){
    dd('salam reza');
})->middleware('auth:api');

Route::group(['prefix' => 'users'],function (){
    Route::namespace('\App\Http\Controllers\API')->group(function (){
        Route::get('/','UserController@index')->middleware('auth:api');
        Route::get('/{id}','UserController@show')->middleware('auth:api');
        Route::post('/','UserController@store');
        Route::put('/{id}','UserController@update')->middleware('auth:api');
        Route::delete('/{id}','UserController@destroy')->middleware('auth:api');
    });
});


Route::group(['prefix' => 'products'],function (){
    Route::namespace('\App\Http\Controllers\API')->group(function (){
        Route::get('/','ProductController@index');
        Route::get('/{id}','ProductController@show');
        Route::post('/','ProductController@store');
        Route::put('/{id}','ProductController@update');
        Route::delete('/{id}','ProductController@destroy');
    });
});
