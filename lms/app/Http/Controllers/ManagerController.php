<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leave;

class ManagerController extends Controller
{
    public function managerdashboard()
    {
 $leaves = Leave::with('user')->get();

        return view('manager.managerdashboard', compact('leaves'));    }
}
