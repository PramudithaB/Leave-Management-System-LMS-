<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        return view('admin.admindashboard');
    }
    public function allUsers()
    {
           $users = User::all();
        return view('admin.allusers', compact('users') );
    }
}
