<?php

namespace Shipu\Installer\Controllers;

use Shipu\Installer\Requests\InstallerRequest;
use App\Http\Controllers\Controller;
use Installer;
use Config;
use View;
use App;

class InstallerController extends Controller
{
    protected $extension;
    protected $filePermission;

    public function __construct()
    {
        $this->extension        = $this->checkPhpExtension();
        $this->filePermission   = $this->checkFolderAndFilePermission();
        View::share('extension', $this->extension);
        View::share('permission', $this->filePermission);
    }
    
    public function index()
    {
        session(['_old_input' => '']);
        return view('Installer::install');
    }

    public function checkPhpExtension()
    {
        $forCheck = ['phpVersion' , 'pdoLibrary', 'mbstring', 'openssl', 'curl', 'zip'];
        $extensionResult = [];
        foreach ($forCheck as $item) {
            $extensionResult[$item] = Installer::checkExtension($item);
        }
        return $extensionResult;
    }

    public function checkFolderAndFilePermission()
    {
        $forCheck = ['storage/app/' , 'storage/framework/', 'storage/logs/', 'bootstrap/cache/'];
        $filePermissionResult = [];
        foreach ($forCheck as $key => $item) {
            $filePermissionResult[$key] = Installer::checkPermission($item);
        }
        return $filePermissionResult;
    }

    public function save(InstallerRequest $input)
    {
        $input = $input->except(['_token']);
                            $key = 'DB_DATABASE';
                            $value = 'shipu';
                            $configKey = 'database.connections.mysql.database';
//        dd( str_replace(
//            $key.'='.env($key),
//            'DB_DATABASE=shipu',
//            file_get_contents(App::environmentFilePath())
//        ));
        Installer::setDriver($input['driver']);
//                            file_put_contents(App::environmentFilePath(), str_replace(
//                                $key.'='.env($key),
//                                $key.'='.$value,
//                                file_get_contents(App::environmentFilePath())
//                            ));
                    //        dd(Config::get('database.connections.mysql.database'));
        foreach ($input as $key => $value) {
//            echo $key." ".$value;
            Installer::setInEnvironment($key, $value);
        }
        session(['_old_input' => $input]);
        return view('Installer::install')->with(['nextView' => 'finish']);
//        return ['nextView' => 'permission'];
    }

    public function finishInstallProcess()
    {
        Installer::setInstallKeyOnEnv();
        return redirect('/');
    }
}
