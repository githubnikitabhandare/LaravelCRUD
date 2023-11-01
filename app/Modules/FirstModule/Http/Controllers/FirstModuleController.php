<?php

namespace App\Modules\FirstModule\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FirstModuleController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        return view("FirstModule::welcome");
    }
}
