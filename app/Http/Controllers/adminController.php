<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\Package;
use App\Models\Checkout;


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

    // If lesson is paid, require an approved payment for this user's purchase of the class
    if ($lesson->is_paid) {
        // require authentication first
        if (! auth()->check()) {
            // send user to login (so middleware won't block checkout page) with intended message
            return redirect()->route('login')->with('error', 'Please login and submit payment to access this paid lesson.');
        }

        $userId = auth()->id();
        $userName = auth()->user()->name ?? null;
        $classId = $lesson->class_id;

        // Use exact-match pattern to avoid partial matches (e.g. "1" matching "10")
        // Check approved checkouts where either user_id matches OR student_name matches signed-in user
        $hasApproved = Checkout::where('status', 'approved')
            ->whereRaw("CONCAT(',', REPLACE(class_id, ' ', ''), ',') LIKE ?", ['%,' . $classId . ',%'])
            ->where(function($q) use ($userId, $userName) {
                $q->where('user_id', $userId);
                if ($userName) {
                    $q->orWhere('student_name', $userName);
                }
            })
            ->exists();

        if (! $hasApproved) {
            return redirect()->route('checkout.page')->with('error', 'Your payment for this class is not approved yet. Please submit payment or wait for approval.');
        }
    }

    return view('classvideo', compact('lesson'));
}

public function classview($id)
{
    $class = ClassModel::with('lessons')->findOrFail($id);

    return view('classview', compact('class'));
}

public function createPackage()
{
    // pass available classes so admin selects one when creating a package
    $classes = ClassModel::orderBy('className')->get();
    return view('admin.package-create', compact('classes'));
}

public function buyclass()
{
    $packages = Package::orderBy('id','desc')->get();

    return view('buyclass', compact('packages'));
}


public function storePackage(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:class_models,id|unique:packages,class_id',
        'description' => 'nullable|string',
        'monthly_fee' => 'required|integer|min:0',
    ]);

    // set package_name from the selected className
    $class = ClassModel::findOrFail($request->class_id);

    Package::create([
        'package_name' => $class->className,
        'description' => $request->description,
        'monthly_fee' => $request->monthly_fee,
        'class_id' => $request->class_id,
    ]);

    return redirect()->route('admindashboard')->with('success', 'Package created and linked to class successfully!');
}
public function checkoutPage()
{
    return view('checkout');
}

public function checkoutSubmit(Request $request)
{
    $request->validate([
        'student_name' => 'required|string|max:255',
        'class_name'   => 'required|string',
        'class_id'     => 'required|string',
        'remark'       => 'nullable|string',
        'file'         => 'nullable|mimes:jpg,png,pdf|max:2048',
    ]);

    // File Upload
    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $request->file('file')->store('checkout_files', 'public');
    }

    // Normalize class_id: remove spaces and ensure comma-separated list like "1,2,3"
    $normalizedClassId = implode(',', array_filter(array_map('trim', explode(',', $request->class_id))));

    // Save to DB, record the user who submitted
    Checkout::create([
        'student_name' => $request->student_name,
        'class_name'   => $request->class_name,
        'class_id'     => $normalizedClassId,
        'remark'       => $request->remark,
        'file_path'    => $filePath,
        'status'       => 'pending',
        'user_id'      => auth()->id(), // record submitting user
    ]);

    return redirect()->route('dashboard')->with('success', 'Checkout completed successfully!');
}
public function paymentmanage()
{
    $checkouts = Checkout::orderBy('created_at', 'desc')->get();

    return view('admin.paymentmanage', compact('checkouts'));


}

public function paymentApprove($id)
{
    $checkout = Checkout::find($id);
    if (!$checkout) {
        return back()->with('error', 'Payment not found.');
    }
    $checkout->status = 'approved';
    $checkout->save();

    return back()->with('success', 'Payment approved.');
}

public function paymentReject($id)
{
    $checkout = Checkout::find($id);
    if (!$checkout) {
        return back()->with('error', 'Payment not found.');
    }
    $checkout->status = 'rejected';
    $checkout->save();

    return back()->with('success', 'Payment rejected.');
}
}