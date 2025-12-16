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

// Edit Class
public function classedit($id)
{
    $class = ClassModel::findOrFail($id);
    return view('admin.class-edit', compact('class'));
}

// Update Class
public function classupdate(Request $request, $id)
{
    $data = $request->validate([
        'className' => 'required|string|max:255',
        'description' => 'nullable|string',
        'teacherName' => 'nullable|string|max:255',
        'classTime' => 'nullable|string|max:255',
        'sessionCount' => 'nullable|integer',
        'month' => 'nullable|string|max:255',
    ]);

    $class = ClassModel::findOrFail($id);
    $class->update($data);

    return redirect()->route('admindashboard')->with('success', 'Class updated successfully!');
}

// Delete Class
public function classdelete($id)
{
    $class = ClassModel::findOrFail($id);
    $class->delete();

    return redirect()->route('admindashboard')->with('success', 'Class deleted successfully!');
}

// Edit Lesson
public function lessonedit($id)
{
    $lesson = Lesson::findOrFail($id);
    $classes = ClassModel::all();
    return view('admin.lesson-edit', compact('lesson', 'classes'));
}

// Update Lesson
public function lessonupdate(Request $request, $id)
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

    $lesson = Lesson::findOrFail($id);
    
    $filePath = $lesson->file_path;

    if ($request->hasFile('file')) {
        // Delete old file if exists
        if ($filePath && \Storage::disk('public')->exists($filePath)) {
            \Storage::disk('public')->delete($filePath);
        }
        $filePath = $request->file('file')->store('lesson_files', 'public');
    }

    $lesson->update([
        'class_id' => $request->class_id,
        'name' => $request->name,
        'description' => $request->description,
        'link' => $request->link,
        'file_path' => $filePath,
        'notice' => $request->notice,
        'is_paid' => $request->is_paid,
    ]);

    return redirect()->route('admindashboard')->with('success', 'Lesson updated successfully!');
}

// Delete Lesson
public function lessondelete($id)
{
    $lesson = Lesson::findOrFail($id);
    
    // Delete file if exists
    if ($lesson->file_path && \Storage::disk('public')->exists($lesson->file_path)) {
        \Storage::disk('public')->delete($lesson->file_path);
    }
    
    $lesson->delete();

    return redirect()->route('admindashboard')->with('success', 'Lesson deleted successfully!');
}

}
