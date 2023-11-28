<?php

namespace App\Http\Controllers;

use App\Models\super_admins;
use Illuminate\Http\Request;

class superAdminControllers extends Controller
{
    public function home()
    {
        return view('home/admin');
    }
    // public function showSuperAdmin()
    // {
    //     $superAdmin=super_admins::all();
    //     return view('superAdmins',compact(['superAdmin']));
    // }
}
