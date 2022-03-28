<?php

//Route::get('/', "home@index");
Route::post("/", "HomeController@post");
//Route::get('/core/d', "HomeController@index");
Route::get('/core/{s}', "HomeController@index", ["middlewares" => 'SampleMiddleware']);
//Route::get('/home/profile/', "/aa/home@index", ["middlewares" => ['SampleMiddleware']]);
//Route::get('/home/{id}', "home@index");
//Route::get('/home/{id}/user', "home@indejjjx");
//Route::get('/home/{id}/{title}', "home@index");
