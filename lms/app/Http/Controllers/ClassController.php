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

        // Week 1–5 validation loop
        'week1Name' => 'nullable|string|max:255',
        'week1Desc' => 'nullable|string',
        'week1LongDesc' => 'nullable|string',
        'week1Link' => 'nullable|url',
        'specialNoticeW1' => 'nullable|string',
        'week1Files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf',

        'week2Name' => 'nullable|string|max:255',
        'week2Desc' => 'nullable|string',
        'week2LongDesc' => 'nullable|string',
        'week2Link' => 'nullable|url',
        'specialNoticeW2' => 'nullable|string',
        'week2Files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf',

        'week3Name' => 'nullable|string|max:255',
        'week3Desc' => 'nullable|string',
        'week3LongDesc' => 'nullable|string',
        'week3Link' => 'nullable|url',
        'specialNoticeW3' => 'nullable|string',
        'week3Files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf',

        'week4Name' => 'nullable|string|max:255',
        'week4Desc' => 'nullable|string',
        'week4LongDesc' => 'nullable|string',
        'week4Link' => 'nullable|url',
        'specialNoticeW4' => 'nullable|string',
        'week4Files.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf',

        

        // Special Class
        'specialClassName' => 'nullable|string|max:255',
        'specialClassDesc' => 'nullable|string',
        'specialClassLongDesc' => 'nullable|string',
        'specialClassLink' => 'nullable|url',
        'specialNoticeSC' => 'nullable|string',
        'specialClassFiles.*' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf',
    ]);

    // -----------------------------
    // FILE UPLOAD HANDLING
    // -----------------------------
    for ($i = 1; $i <= 4; $i++) {
        $fileKey = "week{$i}Files";
        if ($request->hasFile($fileKey)) {
            $uploadedFiles = [];
            foreach ($request->file($fileKey) as $file) {
                $uploadedFiles[] = $file->store("week{$i}", 'public');
            }
            $data[$fileKey] = json_encode($uploadedFiles);
        }
    }

    // Special Class file upload
    if ($request->hasFile('specialClassFiles')) {
        $uploadedFiles = [];
        foreach ($request->file('specialClassFiles') as $file) {
            $uploadedFiles[] = $file->store("specialClass", 'public');
        }
        $data['specialClassFiles'] = json_encode($uploadedFiles);
    }

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
