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
/*
Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function(){
    return view("pages.index");
});
*/
Route::get('/users/{name}/{id}', function($name, $id){
    return "The user is ".$name." with an id of ".$id;
});
Route::get('/', 'PagesController@index'); //returns the index function at the controller
Route::get('/about', 'PagesController@about'); //returns the about page from a controller
Route::get('/services', 'PagesController@services'); //returns the sevices page from a controler
Route::get('/team', 'PagesController@team'); //returns the team function form the controller
Route::get('/contact', 'PagesController@contact');//returns the contact function at the PagesControler that in turn returns the contact view
Route::get('/footer', 'PagesController@footer');
Route::resource('posts','PostsController');
Route::resource('news','ContentsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
