<?php

namespace App\Http\Controllers\Expert;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExpertController extends Controller
{
    public function expertlogout(){
        \Session::flush('success','Thanyou for coming.');        
        \Auth::guard('expert')->logout();
        return redirect()->route('login');
    }
}
