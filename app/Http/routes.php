<?php

Route::group([ 'prefix' => 'v1', 'middleware' => 'cors' ], function () {
    Route::group([ 'middleware' => 'auth' ], function () {
        $exceptRoutes = [ 'create', 'edit' ];

        Route::resource('nurseries', 'NurseriesController', ['except' => $exceptRoutes ]);
        Route::post('nurseries/{document}/{orchidHash}', 'NurseriesController@addOrchid');
        Route::get('nurseries/available-to-orchid/{username}/{orchidHash}', 'NurseriesController@getAvailableToOrchid');

        Route::resource('users', 'UsersController', ['except' => $exceptRoutes ]);

        Route::get('users/{users}/nurseries', [
            'as'   => 'v1.users.nurseries',
            'uses' => 'UsersController@nurseries',
        ]);

        Route::resource('orchids', 'OrchidsController', [ 'except' => $exceptRoutes ]);
        Route::get('orchids/{hash}/{nurseryDocument}', 'OrchidsController@hasNursery');
    });

    Route::post('users/login', 'UsersController@login');
    Route::post('users', 'UsersController@store');
});
