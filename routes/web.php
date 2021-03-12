<?php
use App\Article;
use Illuminate\Support\Facades\Auth;
  


Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/settings', 'HomeController@index')->name('home');
Route::get('/settings/users', 'HomeController@index')->name('home');
Route::get('/settings/sim', 'HomeController@index')->name('home');


Route::get('/logout', 'Auth\LoginController@logout');

// Route::post('/logout', function(){
//     Session::flush();
//     Auth::logout();
//     dd(Auth::user());
// });
