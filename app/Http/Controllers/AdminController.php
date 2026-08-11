<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Campaign;

class AdminController extends Controller
{
    public function index()
    {
        $activeUsers = User::count();
        $adsGenerated = Campaign::where('status', 'completed')->count();
        
        return view('admin.dashboard', compact('activeUsers', 'adsGenerated'));
    }
}
