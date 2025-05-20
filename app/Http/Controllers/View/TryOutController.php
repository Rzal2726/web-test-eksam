<?php

namespace App\Http\Controllers\View;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TryOutController extends Controller
{
    //
    public function tryOutPage(){
        return view("tryout.tryout");
    }
    public function welcomePage(){
        return view("welcome");
    }
}
