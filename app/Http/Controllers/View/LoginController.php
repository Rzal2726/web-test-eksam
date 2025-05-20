<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function loginPage(){
        return view("login.login");
    }
    public function registerPage(){
        return view("login.register");
    }
}
