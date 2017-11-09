<?php

/**
 * Home
*/

Route::get('/', 'HomeController@index')->name('home');

/**
 * Authentication
*/

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::post('/signup', 'AuthController@postSignUp')->middleware('guest');

Route::post('/signin', 'AuthController@postSignIn')->middleware('guest');

Route::get('/signout', 'AuthController@getSignOut')->name('auth.signout');

/**
 * Search
 */

Route::get('/search', 'SearchController@getResults')
	->middleware('auth')->name('search.results');

/**
 * User profile
 */

Route::get('/user/{username}', 'ProfileController@getProfile')
	->middleware('auth')->name('profile.index');

Route::get('/profile/edit', 'ProfileController@getEdit')
	->middleware('auth')->name('profile.edit');

Route::post('/profile/edit', 'ProfileController@postEdit')->middleware('auth');

/**
 * Friends
 */

Route::get('/friends', 'FriendController@getIndex')
    ->middleware('auth')->name('friend.index');

Route::get('/friends/add/{username}', 'FriendController@getAdd')
	->middleware('auth')->name('friend.add');

Route::post('/friends/delete/{username}', 'FriendController@postDelete')
	->middleware('auth')->name('friend.delete');

Route::get('/friends/accept/{username}', 'FriendController@getAccept')
    ->middleware('auth')->name('friend.accept');

/**
 * Messages
 */

Route::group(['prefix' => 'messages'], function () {
    Route::get('/', 'MessagesController@index')->name('messages');
    
    Route::get('create/{id?}', 'MessagesController@create')
        ->name('messages.create');
    
    Route::post('/', 'MessagesController@store')
        ->name('messages.store');

    Route::post('/delete/{id}', 'MessagesController@deleteThread')
        ->name('messages.delete');

    Route::delete('/delete/message/{id}', 'MessagesController@deleteMessage')
        ->name('message.delete');

    Route::get('{id}', 'MessagesController@show')
        ->name('messages.show');
    
    Route::put('{id}', 'MessagesController@update')
        ->name('messages.update');
});

/**
 * Statuses
 */

Route::post('/status', 'StatusController@postStatus')
    ->middleware('auth')->name('status.post');

Route::delete('/status/delete/{statusId}', 'StatusController@deleteStatus')
    ->middleware('auth')->name('status.delete');

Route::post('/status/reply/{statusId}', 'StatusController@postReply')
	->middleware('auth')->name('status.reply');

Route::get('/status/{id}/replies', 'StatusController@getReplies')
    ->middleware('auth')->name('status.replies');

Route::get('/status/replies/{id}', 'StatusController@vueReplies')
    ->middleware('auth')->name('vue.replies');

// Likes
Route::post('/like/{statusId}', 'StatusController@storeLike');
Route::delete('/like/{statusId}', 'StatusController@deleteLike');