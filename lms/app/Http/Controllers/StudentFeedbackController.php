<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class StudentFeedbackController extends Controller
{

    // Show feedback list
    public function feedbackmanage()
    {
        $feedbacks = Feedback::latest()->get();
        return view('admin.feedbackmanage', compact('feedbacks'));
    }


    public function feedbackstore(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'message' => 'required'
        ]);

        Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'message' => $request->message
        ]);

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }
}
