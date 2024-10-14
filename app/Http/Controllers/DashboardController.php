<?php

namespace App\Http\Controllers;

use App\Models\Masjid;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $stats = [
            'total_masjids' => Masjid::where('status', 'active')->count(),
            'total_volunteers' => Masjid::where('status', 'active')->count(),
        ];
        return view('dashboard', compact('stats'));
    }
}