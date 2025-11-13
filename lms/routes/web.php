<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('admindashboard',[AdminController::class,'admindashboard'])->name('admindashboard');
route::get('managerdashboard',[ManagerController::class,'managerdashboard'])->name('manager.managerdashboard')->middleware(['auth','manager']);
route::get('/user/createleave', [UserController::class, 'createleave'])->name('user.createleave');
route::get('userdashboard',[UserController::class,'userdashboard'])->name('userdashboard');
route::post('/user/storeleave', [UserController::class, 'storeleave'])->name('user.storeleave');   
route::delete('/user/leave/delete/{id}', [UserController::class, 'deleteleave'])->name('user.leave.delete');
Route::post('manager/leave/update/{id}', [ManagerController::class, 'updateLeaveStatus'])->name('manager.leave.update');
route::get('manager/users',[ManagerController::class,'users'])->name('manager.users');
route::get('admin/allusers',[AdminController::class,'allusers'])->name('admin.allusers');
Route::post('admin/assign-manager', [AdminController::class, 'assignManager'])->name('admin.assign.manager');
route::get('user/notifications',[UserController::class,'notifications'])->name('user.notifications');
Route::get('/manager/team-leaves', [ManagerController::class, 'getTeamLeaves'])->name('manager.team.leaves');
