<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Route::group(['middleware' => ['web']], function () {  
	Route::get('/', 'PagesController@getIndex');
    Route::get('about', 'PagesController@getAbout');
    
    Route::get('list', ['uses' => 'PagesController@getList', 'as' => 'books.list']);
    Route::get('books/images/{filename}', ['uses' => 'ImageController@getBookImage','as' => 'books.image']);
    
	Route::resource('books', 'BookController');
    Route::resource('films', 'FilmController');
    
});

Route::get('upload', function() {
  return View::make('pages.upload');
});
Route::post('apply/upload', 'ApplyController@upload');
