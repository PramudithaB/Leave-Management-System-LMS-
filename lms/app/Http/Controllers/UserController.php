<?php

namespace App\Http\Controllers;
use App\Models\leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createleave()
    {
        return view('user.createleave');
    }
    public function userdashboard()
    {
        $leave = Leave::where('user_id', Auth::id())->get();
         $user = Auth::user();
    

    return view('user.userdashboard', compact('leave'));
    }
    public function storeleave(Request $request){
        $leave = new leave();
        $leave->user_id = Auth::id();
        $leave->leave_type = $request->leave_type;
        $leave->from_date = $request->from_date;
        $leave->to_date = $request->to_date;
        $leave->reason = $request->reason;
        $leave->save();
        // $leave = Leave::create($request->all());
        return "successfully submitted leave application";
    }
    public function deleteleave($id){
        $leave = leave::find($id);
        $leave->delete();
        return redirect()->back()->with('success', 'Leave application deleted successfully.');
    }
    public function notifications()
    {
        $user = Auth::user();
        $notifications = \App\Models\Notification::where('user_id', $user->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('user.notification', compact('notifications'));
    }
}
