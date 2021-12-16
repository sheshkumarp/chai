<?php

// dump(app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions());

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

    Route::group(['prefix' => 'admin', 'middleware' => 'AdminGeneral', 'namespace'=>'Admin'], function ()
    {

        /*-----------------------------------
        |   Guest Routes
        -------------------------------------------------*/
        Route::group(['middleware' => 'AdminRedirectIfAuthenticated'],function()
        {
            $BASECONTROLLER = 'AuthController@';
            $PREFIX = 'admin.auth.';

                // Default Route
            Route::redirect('/','admin/login');

                // Login
            Route::get('/login',                $BASECONTROLLER.'login')->name($PREFIX.'login');
            Route::post('/login',               $BASECONTROLLER.'checkLogin')->name($PREFIX.'login');

                // Forgot password
            Route::get('/forgot-password',      $BASECONTROLLER.'forgotPassword')->name($PREFIX.'forgot.password');
            Route::post('/forgot-password',     $BASECONTROLLER.'forgotPasswordSubmit')->name($PREFIX.'forgot.password');

                // Reset password
            Route::get('/reset-password/{id}',  $BASECONTROLLER.'resetPassword')->name($PREFIX.'reset.password');
            Route::post('/reset-password/{id}', $BASECONTROLLER.'resetPasswordSubmit')->name($PREFIX.'reset.password');
        });

        /*-----------------------------------
        |   Auth Routes
        -------------------------------------------------*/
        Route::group(['middleware' => 'AdminAuthenticate'],function()
        {
            $PREFIX = 'admin';

            // Logout
            Route::get('/logout',  'Auth\LoginController@logout')->name($PREFIX.'.logout');

            // Dashboard
            Route::group(array('prefix' => 'dashboard'),function() use($PREFIX)
            {
                Route::get('/',  'DashboardController@index')->name($PREFIX.'.dashboard');
            });

            // Category
            Route::group(['middleware' => ['permission:categories']], function () use($PREFIX)
            {
                Route::get('/categories/getRecords', 'CategoryController@getRecords')->name($PREFIX.'.categories.getRecords'); 
                Route::resource('categories', 'CategoryController', ['as' => $PREFIX]);
            });
            
            // Teams
            Route::group(['middleware' => ['permission:teams']], function () use($PREFIX)
            {
                Route::get('/teams/getRecords', 'TeamController@getRecords')->name($PREFIX.'.teams.getRecords'); 
                Route::resource('teams', 'TeamController', ['as' => $PREFIX]);
            });         


            // Users
            Route::group(['middleware' => ['permission:users']], function () use($PREFIX)
            {
                Route::get('/users/getRecords', 'UsersController@getRecords')->name($PREFIX.'.users.getRecords');
                Route::post('/users/updatePassword', 'UsersController@updatePassword')->name($PREFIX.'.users.updatePassword');
                Route::get('/users/downloadAssets/{encId}', 'UsersController@downloadAssetsRecords')->name($PREFIX.'.users.downloadAssetsRecords');
                Route::resource('users', 'UsersController', ['as' => $PREFIX]);
            });

            // Roles
            Route::group(['middleware' => ['permission:users']], function () use($PREFIX)
            {
                Route::get('/roles/getRecords', 'RolesController@getRecords')->name($PREFIX.'.roles.getRecords');
                Route::post('/roles/updateRole/{endID}', 'RolesController@updateRole')->name($PREFIX.'.roles.updateRole');
                Route::resource('roles', 'RolesController', ['as' => $PREFIX]);
            });

            // Permissions
            Route::group(['middleware' => ['permission:users']], function () use($PREFIX)
            {
                Route::post('permissions/byRole', 'PermissionsController@byRole')->name($PREFIX.'.permissions.byrole');
                Route::post('permissions/getUserPermissions', 'PermissionsController@getUserPermissions')->name($PREFIX.'.permissions.getuserpermission');
                Route::get('permissions/getRole', 'PermissionsController@getRole')->name($PREFIX.'.permissions.getRole');
                Route::resource('permissions', 'PermissionsController', ['as' => $PREFIX]);
            });


             // Admin
            Route::group(['middleware' => ['permission:admins']], function () use($PREFIX)
            {
                Route::get('records/getRecords', 'AdminController@getRecords')->name($PREFIX.'.records.getRecords');
                Route::post('records/updatePassword', 'AdminController@updatePassword')->name($PREFIX.'.records.updatePassword');;
                Route::resource('records', 'AdminController', ['as' => $PREFIX]);
            });

        });
    });


/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

    Route::group(['middleware' => ['WebGeneral'], 'namespace' => 'Web'], function ()
    {
        
        /*-----------------------------------
        |   Guest Routes
        -------------------------------------------------*/
        Route::group(['middleware' => 'WebRedirectIfAuthenticated'],function()
        {
            $BASECONTROLLER = 'AuthController@';
            $PREFIX = 'web.auth.';

            // Default Route
            Route::redirect('/','/login');

            // Login
            Route::get('/login',                $BASECONTROLLER.'login')->name($PREFIX.'login');
            Route::post('/login',               $BASECONTROLLER.'checkLogin')->name($PREFIX.'login');

        });

        /*-----------------------------------
        |   Auth Routes
        -------------------------------------------------*/
        Route::group(['middleware' => 'WebAuthenticate'],function()
        {
            $PREFIX = 'web';

            // Logout
            Route::get('/logout',  'Auth\LoginController@logout')->name($PREFIX.'.logout');

            // users
            Route::post('/users/updatePassword', 'UsersController@updatePassword');
            Route::resource('users', 'UsersController', ['as' => $PREFIX]);
            
            // assets
            Route::post('/asset/upload-files', 'AssetController@uploadFiles')->name($PREFIX.'.asset.uploadfiles');
            Route::post('/asset/remove-files', 'AssetController@removeFiles')->name($PREFIX.'.asset.removefiles');
            Route::post('/asset/media-files', 'AssetController@mediaFiles')->name($PREFIX.'.asset.mediafiles');
            Route::get('/asset/getRecords', 'AssetController@getRecords')->name($PREFIX.'.asset.getRecords'); 
            Route::resource('asset', 'AssetController', ['as' => $PREFIX]);

            // Convertmoney
            Route::post('/convertmoney',  'DashboardController@convertmoney')->name($PREFIX.'.convertmoney');

            // Dashboard
            Route::get('/',  'DashboardController@index')->name($PREFIX.'.dashboard');


        });        
         
    });


/*
|--------------------------------------------------------------------------
| COMMAND ROUTES
|--------------------------------------------------------------------------
*/

    //Clear Route cache:
    Route::get('/clear-cache', function() 
    {
        $exitCode = Artisan::call('cache:clear');
        return '<h1>Cache facade value cleared</h1>';
    });

    //Clear Route cache:
    Route::get('/route-clear', function() 
    {
        $exitCode = Artisan::call('route:clear');
        return '<h1>Route cache cleared</h1>';
    });

    //Clear View cache:
    Route::get('/view-clear', function() 
    {
        $exitCode = Artisan::call('view:clear');
        return '<h1>View cache cleared</h1>';
    });

    //Clear config cache:
    Route::get('/config-clear', function() 
    {
        $exitCode = Artisan::call('config:clear');
        return '<h1>View cache cleared</h1>';
    });