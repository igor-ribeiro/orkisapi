<?php

Route::group([ 'prefix' => 'v1' ], function () {
    $exceptRoutes = [ 'create', 'edit' ];
    
    Route::resource('nurseries', 'NurseriesController', ['except' => $exceptRoutes ]);

    Route::resource('users', 'UsersController', ['except' => $exceptRoutes ]);
    Route::get('users/{users}/nurseries', [
        'as'   => 'v1.users.nurseries',
        'uses' => 'UsersController@nurseries',
    ]);
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
