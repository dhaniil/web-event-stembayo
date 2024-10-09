<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidebarController extends Controller
{
    public function getUserInfo()
    {
        $user = Auth::user(); // Get the authenticated user

        return view('events.eventonly', compact('user')); // Pass user data to the view
    }
}