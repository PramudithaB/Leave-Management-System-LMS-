<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;

class ManagerController extends Controller
{public function managerdashboard()
    {
        // Show only pending leaves first
        $leaves = Leave::with('user')->where('status', 'pending')->get();

        return view('manager.managerdashboard', compact('leaves'));
    }

    public function updateLeaveStatus(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->status = $request->status;
        $leave->remarks = $request->remarks;
        $leave->save();

        return redirect()->back()->with('success', 'Leave status updated successfully.');
    }
    public function users()
    {
        $users = User::all();
        return view('manager.users', compact('users') );
    }

}
