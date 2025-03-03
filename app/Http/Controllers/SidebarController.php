<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SidebarController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('layouts.sidebar', compact('user'));
    }
}
