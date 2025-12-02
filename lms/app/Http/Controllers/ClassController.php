<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;  // ✔️ import new model name
use App\Models\Lesson;

class ClassController extends Controller
{
    public function classmanage(){
        return view('admin.classmanage');
    }
    
public function classstore(Request $request)
{
    $data = $request->validate([
        'className' => 'required|string|max:255',
        'description' => 'nullable|string',
        'teacherName' => 'nullable|string|max:255',
        'classTime' => 'nullable|string|max:255',
        'sessionCount' => 'nullable|integer',
        'month' => 'nullable|string|max:255',

    ]);

    ClassModel::create($data);

    return response()->json(['status' => 'success']);
}



public function dashboard()
{
    $classes = ClassModel::all();
    return view('dashboard', compact('classes'));
}



 public function lessoncreate()
    {
        $classes = ClassModel::all();
        return view('admin.create-lesson', compact('classes'));
    }



public function lessonstore(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:class_models,id',
        'name' => 'required|string',
        'description' => 'nullable|string',
        'link' => 'nullable|string',
        'file' => 'nullable|mimes:pdf,jpg,jpeg,png|max:4096',
        'notice' => 'nullable|string',
        'is_paid' => 'required|boolean'
    ]);

    $filePath = null;

    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('lesson_files', 'public');
    }

    Lesson::create([
        'class_id' => $request->class_id,
        'name' => $request->name,
        'description' => $request->description,
        'link' => $request->link,
        'file_path' => $filePath,
        'notice' => $request->notice,
        'is_paid' => $request->is_paid,
    ]);

    return redirect()->route('admindashboard')->with('success', 'Lesson created!');
}


}
