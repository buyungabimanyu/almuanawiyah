<?php

use Illuminate\Support\Facades\{Route, Auth};

// Halaman Home
Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

// Halaman Blog Posts
Route::get('/blogposts', ['as' => 'blogposts', 'uses' => 'HomeController@blogposts'] );

// Halaman Single Post
Route::get('/blogposts/{post:slug}', ['as' => 'blogpost', 'uses' => 'HomeController@blogpost'] );


Auth::routes(['verify' => true]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);

	Route::group(['middleware'=> 'verified'], function () {
		Route::put('/profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
		Route::put('/profile/password', ['as'=> 'profile.password', 'uses' => 'ProfileController@password']);
	});
	
	Route::group(['middleware' => 'editor'], function () {
		Route::resource('/post', 'PostController');
	});
	
	Route::group(['middleware' => 'admin'], function(){
		Route::resource('/categories', 'CategoryController');

		Route::resource('/users', 'UsersController')->except('show');
		Route::put('/users/{user:username}/mEditor', ['as' => 'users.mEditor', 'uses' => 'UsersController@mEditor']);
		Route::put('/users/{user:username}/mAdmin', ['as' => 'users.mAdmin', 'uses' => 'UsersController@mAdmin']);

		Route::get('/allposts', ['as' => 'allposts.index', 'uses' => 'AllpostsController@index']);
		Route::get('/allposts/{post:slug}', ['as' => 'allposts.show', 'uses' => 'AllpostsController@show']);
		Route::delete('/allposts/{post:slug}', ['as' => 'allposts.destroy', 'uses' => 'AllpostsController@destroy']);
		
		Route::get('/views/index', ['as' => 'indexview', 'uses' => 'VIewsController@index']);
		Route::get('/views/main', ['as' => 'mainview', 'uses' => 'VIewsController@MainView']);
		Route::get('/views/home', ['as' => 'homeview', 'uses' => 'ViewsController@HomeView']);
		Route::get('/views/about', ['as' => 'aboutview', 'uses' => 'ViewsController@AboutView']);
		Route::get('/views/courses', ['as' => 'coursesview', 'uses' => 'ViewsController@CoursesView']);
		Route::get('/views/contact', ['as' => 'contactview', 'uses' => 'ViewsController@ContactView']);
		Route::get('/views/footer', ['as' => 'footerview', 'uses' => 'ViewsController@FooterView']);
		Route::get('/views/blog', ['as' => 'blogview', 'uses' => 'ViewsController@BlogView']);

		Route::post('/views/main',['as' => 'main.store', 'uses' => 'ViewsController@MainStore']);
		Route::put('/views/main/{views}',['as' => 'main.update', 'uses' => 'ViewsController@MainUpdate']);

		Route::post('/views/blog',['as' => 'blog.store', 'uses' => 'ViewsController@BlogStore']);
		Route::put('/views/blog/{views}',['as' => 'blog.update', 'uses' => 'ViewsController@BlogUpdate']);

		Route::post('/views/home',['as' => 'home.store', 'uses' => 'ViewsController@HomeStore']);
		Route::put('/views/home',['as' => 'home.update', 'uses' => 'ViewsController@HomeUpdate']);

		Route::post('/views/about',['as' => 'about.store', 'uses' => 'ViewsController@AboutStore']);
		Route::put('/views/about',['as' => 'about.update', 'uses' => 'ViewsController@AboutUpdate']);

		Route::resource('setting', 'SettingController')->except(['show', 'create', 'edit', 'destroy']);
		Route::get('/setting/footer/create', ['as' => 'footer.create', 'uses' => 'SettingController@createFooter']);
		Route::post('/setting/footer', ['as' => 'footer.store', 'uses' => 'SettingController@storeFooter']);
		Route::get('/setting/footer/{setting}/edit', ['as' => 'footer.edit', 'uses' => 'SettingController@editFooter']);
		Route::put('/setting/footer/{setting}', ['as' => 'footer.update', 'uses' => 'SettingController@updateFooter']);
		Route::delete('/setting/footer/{setting}', ['as' => 'footer.destroy', 'uses' => 'SettingController@destroyFooter']);

	});

	Route::get('/checkSlug', ['as' => 'checkslug', 'uses' => 'CheckslugController']);
});