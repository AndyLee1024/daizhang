<?php

namespace App\Http\Controllers\Weixin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Auth;
use Input;
use Validator;
use View;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @version 1.0
 * @author  AndyLee <root@lostman.org>
 */
class BindController extends Controller
{
    public function index(){
        return view('wx.login');
    }

    public function bind(){

    }

    public function sendSMSCode(){

    }
}
