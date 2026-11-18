<?php

namespace App\Http\Controllers;

use App\Models\Report;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $reports = Report::with(['category', 'dormitory'])
                ->latest()
                ->take(5)
                ->get();

            $total = Report::count();

            $pending = Report::where('status', 'Pending')->count();

            $diproses = Report::where('status', 'Diproses')->count();

            $selesai = Report::where('status', 'Selesai')->count();
        } else {
            $reports = Report::with(['category', 'dormitory'])
                ->where('user_id', auth()->id())
                ->latest()
                ->take(5)
                ->get();

            $total = Report::where('user_id', auth()->id())->count();

            $pending = Report::where('user_id', auth()->id())
                ->where('status', 'Pending')
                ->count();

            $diproses = Report::where('user_id', auth()->id())
                ->where('status', 'Diproses')
                ->count();

            $selesai = Report::where('user_id', auth()->id())
                ->where('status', 'Selesai')
                ->count();
        }

        return view('dashboard', compact(
            'reports',
            'total',
            'pending',
            'diproses',
            'selesai'
        ));
    }
}