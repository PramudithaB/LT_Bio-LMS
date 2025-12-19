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


    // public function feedbackstore(Request $request)
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

    public function feedbackstore(Request $request)
    {
        // Basic validation
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone_number' => 'required|string|max:50',
            'message' => 'required|string|max:2000',
        ]);

        // If a feedback with the same email exists, update it instead of inserting a duplicate
        $existing = Feedback::where('email', $data['email'])->first();

        if ($existing) {
            $existing->name = $data['name'];
            $existing->phone_number = $data['phone_number'];
            $existing->message = $data['message'];
            $existing->status = 'pending';
            $existing->save();

            return back()->with('success', 'Your feedback was updated and is awaiting approval.');
        }

        // Create new feedback
        Feedback::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone_number' => $data['phone_number'],
            'message' => $data['message'],
            'status' => 'pending'
        ]);

        return back()->with('success', 'Your feedback has been submitted and is awaiting approval.');
    }
}
