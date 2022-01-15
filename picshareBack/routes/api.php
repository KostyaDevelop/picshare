<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//User
Route::post('/reg-user', 'App\Http\Controllers\Api\UserController@userReg');
Route::post('/log-user', 'App\Http\Controllers\Api\UserController@userLogin');
Route::get('/get-user-info{userID}', 'App\Http\Controllers\Api\UserController@getUserInfo');
Route::get('/set-user-info{userID}/{userSubsID}', 'App\Http\Controllers\Api\UserController@setUserInfo');
Route::post('/reg-user', 'App\Http\Controllers\Api\UserController@userReg');
Route::get('/get-user-info-settings/{userID}', 'App\Http\Controllers\Api\UserController@getUserInfoForSettings');

//UserSubscribes
Route::get('/get-user-subscriptions{userID}', 'App\Http\Controllers\Api\SubscriberController@getUserSubscriptions');
Route::get('/get-user-subscribers{userID}', 'App\Http\Controllers\Api\SubscriberController@getUserSubscribers');

//Avatar
Route::post('/set-avatar', 'App\Http\Controllers\Api\AvatarController@setAvatar');
Route::post('/refresh-avatar', 'App\Http\Controllers\Api\AvatarController@refreshAvatar');
Route::delete('/delete-avatar{userID}', 'App\Http\Controllers\Api\AvatarController@deleteAvatar');

//Photo
Route::get('/get-friends-photos{userID}', 'App\Http\Controllers\Api\PhotoController@getFriendsPhotos');
Route::post('/add-user-photo', 'App\Http\Controllers\Api\PhotoController@addUserPhoto');
Route::get('/get-user-photos{userID}', 'App\Http\Controllers\Api\PhotoController@getUserPhotos');
Route::get('/get-photo-info{photoID}', 'App\Http\Controllers\Api\PhotoController@getPhotoInfo');
Route::delete('/delete-photo{photoID}', 'App\Http\Controllers\Api\PhotoController@photoDelete');

//PhotoLike
Route::put('/set-photo-like/{photoID}/{userLogID}', 'App\Http\Controllers\Api\PhotoController@setOrDelPhotoLike');

//PhotoComment
Route::post('/set-photo-com', 'App\Http\Controllers\Api\PhotoController@setPhotoComment');
Route::get('/get-photo-com{photoID}', 'App\Http\Controllers\Api\PhotoController@getPhotoComment');

//Posts
Route::get('/get-user-posts{userID}', 'App\Http\Controllers\Api\PostController@getUserPosts');

//People
Route::get('/get-people', 'App\Http\Controllers\Api\UserController@getPeople');

//UserNotifications
//Route::get('/get-notifications', 'App\Http\Controllers\Api\UserController@getUserNotifications');


