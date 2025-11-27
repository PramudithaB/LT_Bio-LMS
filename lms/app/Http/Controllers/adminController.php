<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;


class adminController extends Controller
{
    public function admindashboard(){
        $classes = ClassModel::all();   // or ->orderBy('id','desc')->get()
    return view('admin.admindashboard', compact('classes'));
    }
  
    public function classvideo(){
        return view('classvideo');
    }

  public function classview(){
       $classes = ClassModel::all();   // or ->orderBy('id','desc')->get()
    return view('classview', compact('classes'));
    }
}
