<?php

namespace Shipu\Installer;

use Illuminate\Support\ServiceProvider;
use App;
/**
 * Class InstallerServiceProvider
 * @package Shipu\Installer
 */
class InstallerServiceProvider extends ServiceProvider
{

    /**
     *
     */
    public function boot()
    {
        $routes = __DIR__.'/routes.php';
        $views  = __DIR__.'/Views';
        $lang   = __DIR__.'/Lang';
        $helper = __DIR__.'/helper.php';

        if(file_exists($routes)) {
            include $routes;
        }

        if(file_exists($helper)) {
            include $helper;
        }

        if(is_dir($views)) {
            $this->loadViewsFrom($views, 'Installer');
        }

        if(is_dir($lang)) {
            $this->loadTranslationsFrom($lang,'Installer');
        }

        $this->app['router']->middleware('installer', '\Shipu\Installer\Middleware\InstallerMiddleware');
//        dd($this->app->request->all());
    }

    public function register()
    {
        $this->app->bind('installer', function()
        {
            return new \Shipu\Installer\Installer;
        });
    }
}