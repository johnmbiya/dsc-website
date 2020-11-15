<?php

use Illuminate\Support\Facades\Route;

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

// Frontend Route
Route::group(['middleware' => 'web'], function () {

	Route::get('/', [App\Http\Controllers\FrontEndController::class, 'index'])->name('index');
	Route::get('/learn', [App\Http\Controllers\FrontEndController::class, 'learn'])->name('learn');
	Route::get('/projects', [App\Http\Controllers\FrontEndController::class, 'projects'])->name('projects');
	
});

// Authentication Route
Route::get('/login/google', [App\Http\Controllers\Auth\OAuthController::class, 'redirectToGoogle'])->name('google');
Route::get('login/google/callback', [App\Http\Controllers\Auth\OAuthController::class, 'handleGoogleCallback']);

Route::get('login/github', [App\Http\Controllers\Auth\OAuthController::class, 'redirectToGitHub'])->name('github');
Route::get('login/github/callback', [App\Http\Controllers\Auth\OAuthController::class, 'handleGitHubCallback']);

Route::get('login/facebook', [App\Http\Controllers\Auth\OAuthController::class, 'redirectToFacebook'])->name('facebook');
Route::get('login/facebook/callback', [App\Http\Controllers\Auth\OAuthController::class, 'handleFacebookCallback']);
Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Lead Route
Route::group(['namespace' => 'Lead','prefix' => 'lead', 'as' => 'lead.', 'middleware' => ['auth','role:lead','verified']], function () {
	// Dashboard
	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
	// Roles

	Route::resource('roles', 'RolesController');
	// Teams
	Route::resource('teams', 'TeamsController');
	// Users
	Route::resource('users', 'UsersController', ['except' => ['show']]);
	// Profile
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	  Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	  Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	// SiteMap
	Route::get('sitemap', function () {
	  SitemapGenerator::create(config('app.url'))->writeToFile('sitemap.xml');
  
	  return view('frontend.sitemap');
	})->name('sitemap');
});

// Technical Core Team Route
Route::group(['namespace' => 'TechCoreTeam', 'prefix' => 'techcore', 'as' => 'core.', 'middleware' => ['auth','role:techcore','verified']], function () {
	// Dashboard
	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
	// Profile
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	  Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	  Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});

// Non-Technical Core Team Route
Route::group(['namespace' => 'NonTechCoreTeam','prefix' => 'nontechcore', 'as' => 'noncore.', 'middleware' => ['auth','role:nontechcore','verified']], function () {
	// Dashboard
	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
	// Profile
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	  Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	  Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
  });
  
// Member Route
Route::group(['namespace' => 'Member','prefix' => 'member', 'as' => 'member.', 'middleware' => ['auth','role:member','verified']], function () {
	// Dashboard
	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
	// Profile
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	  Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	  Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});


// Route::group(['namespace' => 'TechCoreTeam','prefix' => 'techcore', 'as' => 'core.', 'middleware' => ['auth','role:techcore','verified']], function () {

// 	// Dashboard
// 	Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
// 	//profile
// 	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	
// 	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
// 	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
// 	//Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
// 	 Route::get('map', function () {return view('pages.maps');})->name('map');
// 	 Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
// 	 Route::get('table-list', function () {return view('pages.tables');})->name('table');
// 	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
// });

