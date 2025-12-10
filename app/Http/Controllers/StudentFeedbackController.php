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

    // Approve feedback
    public function feedbackapprove($id)
    {
        $feedback = Feedback::find($id);
        $feedback->status = 'approved';
        $feedback->save();

        return back()->with('success', 'Feedback approved successfully');
    }

    // Delete feedback
    public function feedbackdelete($id)
    {
        Feedback::find($id)->delete();

        return back()->with('success', 'Feedback deleted successfully');
    }


    public function feedbackstore(Request $request)
    // {

    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'phone_number' => 'required',
    //         'message' => 'required'
    //     ]);

    //     Feedback::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'phone_number' => $request->phone_number,
    //         'message' => $request->message
    //     ]);

    //     return redirect()->back()->with('success', 'Feedback submitted successfully!');
    // }

    {
        Feedback::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'message' => $request->message,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Your feedback has been submitted and awaiting approval.');
    }
}
