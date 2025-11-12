<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function adminDashboard()
    {
           $managers = User::where('usertype', 'manager')->get();
        $users = User::where('usertype', 'user')->with('manager')->get();

        return view('admin.admindashboard', compact('managers', 'users'));
    }
    public function allUsers()
    {
           $users = User::all();
        return view('admin.allusers', compact('users') );
    }
     public function assignManager(Request $request)
    {
        $request->validate([
            'manager_id' => 'required|exists:users,id',
            'user_ids' => 'required|array|min:1',
        ]);

        // Optional: each manager max 5 users
        $currentCount = User::where('manager_id', $request->manager_id)->count();
        if ($currentCount + count($request->user_ids) > 5) {
            return back()->with('error', '⚠️ This manager already has 5 users assigned.');
        }

        User::whereIn('id', $request->user_ids)->update(['manager_id' => $request->manager_id]);

        return back()->with('success', '✅ Manager assigned to selected users successfully.');
    }
}
