<?php
/**
 * Created by PhpStorm.
 * User: shipu
 * Date: 6/29/16
 * Time: 8:11 PM
 */
//use Config;

Route::group(['namespace' => '\Shipu\Installer\Controllers', 'middleware' => 'web'], function () {

    Route::group(['middleware' => 'notInstall'], function()
    {
        Route::get('install', 'InstallerController@index');
        Route::post('install', 'InstallerController@save');
        Route::get('finishinstallation', 'InstallerController@finishInstallProcess');

        Route::get('test', function () {
            if(substr(sprintf('%o', fileperms(base_path('storage/logs/'))), -4) >= 775)
                dd("ok");
            dd("not ok");
        });
    });


});