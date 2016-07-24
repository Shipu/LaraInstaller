<?php

namespace Shipu\Installer\Requests;

use App\Http\Requests\Request;

class InstallerRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'driver' => 'required',
            'host' => 'required',
            'database' => 'required',
            'username' => 'required',
            'password' => 'required',
        ];
    }
}