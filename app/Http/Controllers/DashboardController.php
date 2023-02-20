<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request) {
        $wedding = auth()->user()->weddings;
        return view('dashboard', compact('wedding'));
    }
}
