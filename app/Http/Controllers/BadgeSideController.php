<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgeSideController extends Controller
{
    public function index(Request $request)
    {
       return view('user.admin.badge_side.index');
    }
}
