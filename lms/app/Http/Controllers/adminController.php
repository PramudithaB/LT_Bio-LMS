<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\Package;


class adminController extends Controller
{
    public function admindashboard(){
        $classes = ClassModel::all();
            $users = User::orderBy('id', 'desc')->get();
                $packages = Package::orderBy('id','desc')->get(); // 👈 ADD THIS
   // 👈 fetch all registered users
   // or ->orderBy('id','desc')->get()
    return view('admin.admindashboard', compact('classes','users','packages'));
    }
  
  public function classvideo($lessonId)
{
    $lesson = \App\Models\Lesson::findOrFail($lessonId);

    return view('classvideo', compact('lesson'));
}

public function classview($id)
{
    $class = ClassModel::with('lessons')->findOrFail($id);

    return view('classview', compact('class'));
}

public function createPackage()
{
    return view('admin.package-create');
}

public function storePackage(Request $request)
{
    $request->validate([
        'package_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'monthly_fee' => 'required|integer|min:0',
    ]);

    Package::create($request->all());

    return redirect()->route('admindashboard')->with('success', 'Package created successfully!');
}

}
