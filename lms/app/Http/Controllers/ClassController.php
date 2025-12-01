<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;  // ✔️ import new model name

class ClassController extends Controller
{
    public function classmanage(){
        return view('admin.classmanage');
    }
    
public function classstore(Request $request)
{
    // -----------------------------
    // VALIDATION
    // -----------------------------
    $data = $request->validate([
        'className' => 'required|string|max:255',
        'description' => 'nullable|string',
        'teacherName' => 'nullable|string|max:255',
        'classTime' => 'nullable|string|max:255',
        'sessionCount' => 'nullable|integer',
        'month' => 'nullable|string|max:255',

      

        

       
    ]);

  

   

    // -----------------------------
    // INSERT INTO DATABASE
    // -----------------------------
    ClassModel::create($data);

    return response()->json(['status' => 'success']);
}



public function dashboard()
{
    $classes = ClassModel::all();
    return view('dashboard', compact('classes'));
}

}
