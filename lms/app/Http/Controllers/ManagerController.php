<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function managerdashboard()
{
    $manager = Auth::user();

    // Get all team members under this manager
    $teamMembers = User::where('manager_id', $manager->id)->get();

    // Only show pending leaves of this manager’s team
    $leaves = Leave::with('user')
        ->whereIn('user_id', $teamMembers->pluck('id'))
        ->where('status', 'pending')
        ->get();

    return view('manager.managerdashboard', compact('leaves', 'teamMembers', 'manager'));
}


    public function updateLeaveStatus(Request $request, $id)
    {
        $leave = Leave::findOrFail($id);
        $leave->status = $request->status;
        $leave->remarks = $request->remarks;
        $leave->save();

          \App\Models\Notification::create([
        'user_id' => $leave->user_id,
        'title' => 'Leave ' . ucfirst($request->status),
        'message' => 'Your leave from ' . $leave->from_date . ' to ' . $leave->to_date .
                     ' has been ' . $request->status .
                     ' with remark: "' . $request->remarks . '"',
    ]);

        return redirect()->back()->with('success', 'Leave status updated successfully.');
    }
    public function users()
    {
        $users = User::all();
        return view('manager.users', compact('users') );
    }
    public function getTeamLeaves()
{
    $manager = Auth::user();
    $teamMembers = User::where('manager_id', $manager->id)->pluck('id');

    $leaves = Leave::with('user')
        ->whereIn('user_id', $teamMembers)
        ->where('status', 'approved') // show only approved leaves in calendar
        ->get();

    $events = [];

    foreach ($leaves as $leave) {
        $events[] = [
            'title' => $leave->user->name . ' (' . ucfirst($leave->leave_type) . ')',
            'start' => $leave->from_date,
            'end'   => \Carbon\Carbon::parse($leave->to_date)->addDay()->toDateString(), // include end date fully
            'color' => '#28a745', // green color for approved leaves
            'description' => $leave->remarks ?? '',
        ];
    }

    return response()->json($events);
}


}
