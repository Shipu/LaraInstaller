<?php
/**
 * Created by PhpStorm.
 * User: shipu
 * Date: 6/29/16
 * Time: 3:31 AM
 */

namespace Shipu\Installer;

use App;
use Config;
/**
 * Class Installer
 * @package App
 */
class Installer
{
    protected $driver;

    public function setDriver($value)
    {
        $this->driver = $value;
    }

    public function checkExtension($check)
    {
        $result = false;
        switch ($check) {
            case 'phpVersion':
                $result = version_compare(PHP_VERSION , "5.5.9", ">=");
                break;
            case 'pdoLibrary':
                $result = defined('PDO::ATTR_DRIVER_NAME');
                break;
            case 'mbstring':
                $result = extension_loaded('mbstring');
                break;
            case 'openssl':
                $result = extension_loaded('openssl');
                break;
            case 'gd':
                $result = extension_loaded('gd');
                break;
            case 'curl':
                $result = function_exists('curl_init') && defined('CURLOPT_FOLLOWLOCATION');
                break;
            case 'zip':
                $result = class_exists('ZipArchive');
                break;
        }

        return $result;
    }

    public function checkPermission($path)
    {
        $getPermission = substr(sprintf('%o', fileperms(base_path($path))), -4);
        if($getPermission >= 775) {
            return true;
        }

        return false;
    }

    public function getEnvKey($key)
    {
        $result = false;
        switch ($key) {
            case 'database':
                $result = 'DB_DATABASE';
                break;
            case 'username':
                $result = 'DB_USERNAME';
                break;
            case 'password':
                $result = 'DB_PASSWORD';
                break;
            case 'driver':
                $result = 'DB_CONNECTION';
                break;
            case 'host':
                $result = 'DB_HOST';
                break;
        }

        return $result;
    }

    public function setInEnvironment($key, $value)
    {
        $this->setKeyInEnvironmentFileUsingEnv($this->getEnvKey($key), $value);
        // $this->setKeyInEnvironmentFileUsingConfig( $this->getEnvKey($key), 'database.connections.'.$this->driver.'.'.$key, $value ); // Except Driver replacing
    }

    protected function setKeyInEnvironmentFileUsingConfig($key, $configKey ,$value)
    {
        file_put_contents(App::environmentFilePath(), str_replace(
            $key.'='.Config::get($configKey),
            $key.'='.$value,
            file_get_contents(App::environmentFilePath())
        ));
    }

    protected function setKeyInEnvironmentFileUsingEnv($key, $value)
    {
//        dd(env($key));
        file_put_contents(App::environmentFilePath(), str_replace(
            $key.'='.env($key),
            $key.'='.$value,
            file_get_contents(App::environmentFilePath())
        ));
    }

    public function setInstallKeyOnEnv()
    {
        file_put_contents(App::environmentFilePath(), str_replace(
            'APP_URL='.env('APP_URL'),
            "APP_URL=".env('APP_URL')."\nAPP_INSTALL=true\n",
            file_get_contents(App::environmentFilePath())
        ));
    }
    
    
}