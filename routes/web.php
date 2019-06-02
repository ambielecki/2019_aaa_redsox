<?php

Auth::routes();

Route::get('/', 'HomeController@getHome')->name('home');

Route::group(['prefix' => '/blog'], function () {
    Route::get('/list', 'BlogController@getList')->name('blog_list');
    Route::get('/{slug}', 'BlogController@getView')->name('blog_view');
});

Route::group(['prefix' => '/event'], function () {
    Route::get('/list', 'EventController@getList')->name('event_list');
    Route::get('/{id}', 'EventController@getView')->name('event_view');
});


Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
    Route::get('/', 'AdminController@getIndex')->name('admin');

    Route::group(['prefix' => '/home'], function () {
        Route::get('/{id?}', 'HomeController@getEdit')->name('admin_home_edit');
        Route::post('/', 'HomeController@postEdit');
    });

    Route::group(['prefix' => '/images'], function () {
        Route::get('/', 'ImageController@getAdminList')->name('admin_image_list');
        Route::get('/create', 'ImageController@getAdminCreate')->name('admin_image_create');
        Route::post('/create', 'ImageController@postAdminCreate');
        Route::get('/edit/{id}', 'ImageController@getAdminEdit')->name('admin_image_edit');
        Route::post('/edit/{id}', 'ImageController@postAdminEdit');
    });

    Route::group(['prefix' => '/blog'], function () {
        Route::get('/', 'BlogController@getAdminList')->name('admin_blog_list');
        Route::get('/create', 'BlogController@getAdminCreate')->name('admin_blog_create');
        Route::post('/create', 'BlogController@postAdminCreate');
        Route::get('/edit/{id}', 'BlogController@getAdminEdit')->name('admin_blog_edit');
        Route::post('/edit/{id}', 'BlogController@postAdminEdit');
    });

    Route::group(['prefix' => '/event'], function () {
        Route::get('/', 'EventController@getAdminList')->name('admin_event_list');
        Route::get('/create', 'EventController@getAdminCreate')->name('admin_event_create');
        Route::post('/create', 'EventController@postAdminCreate');
        Route::get('/edit/{id}', 'EventController@getAdminEdit')->name('admin_event_edit');
        Route::post('/edit/{id}', 'EventController@postAdminEdit');
    });

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('test', 'TestController@getTest');
});

// web api group
Route::group(['prefix' => '/api'], function () {
    Route::post('/heartbeat', 'HeartbeatController@postHeartbeat');

    Route::group(['prefix' => '/blog'], function () {
        Route::get('/list', 'BlogController@getApiList');
    });

    Route::group(['prefix' => '/event'], function () {
        Route::get('/list', 'EventController@getApiList');
    });

    // admin api routes
    Route::group(['prefix' => '/admin', 'middleware' => ['admin']], function () {
        // admin image api routes
        Route::group(['prefix' => '/images'], function () {
            Route::get('/', 'ImageController@getAdminApiList')->name('api_admin_image_list');
            Route::get('/{id}', 'ImageController@getAdminApiDetail')->name('api_admin_image_detail');
        });

        Route::group(['prefix' => '/blog'], function () {
            Route::post('/slug-check', 'BlogController@postAdminApiSlugCheck')->name('api_admin_blog_slug_check');
        });

        Route::group(['prefix' => '/home'], function () {
            Route::get('/list', 'HomeController@getApiList')->name('api_admin_home_list');
        });
    });
});
