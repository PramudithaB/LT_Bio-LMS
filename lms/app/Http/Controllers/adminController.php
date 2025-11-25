<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class adminController extends Controller
{
    public function admindashboard(){
        return view('admin.admindashboard');
    }
    public function classview(){
        return view('classview');
    }
    public function classvideo(){
        return view('classvideo');
    }
}
