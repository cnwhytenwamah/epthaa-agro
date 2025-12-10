<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;

class UserDashboardController extends Controller
{
    public function index():View
    {
        $title = "User Dashboard";

        return view('users.dashboard', compact('title'));
    }
}
