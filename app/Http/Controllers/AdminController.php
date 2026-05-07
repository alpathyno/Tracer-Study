<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TracerStudy;
use App\Models\AlumniProfile;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalAlumni = User::where('role', 'alumni')->count();

        $statusCounts = TracerStudy::select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $working = $statusCounts['working'] ?? 0;
        $studying = $statusCounts['studying'] ?? 0;
        $entrepreneur = $statusCounts['entrepreneur'] ?? 0;
        $unemployed = $statusCounts['unemployed'] ?? 0;

        $avgWaitingTime = TracerStudy::avg('waiting_time') ?? 0;

        $recentTracers = TracerStudy::with('user')
            ->latest()
            ->limit(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalAlumni',
            'working',
            'studying',
            'entrepreneur',
            'unemployed',
            'avgWaitingTime',
            'recentTracers'
        ));
    }

    public function analytics()
    {
        $totalAlumni = User::where('role', 'alumni')->count();
        $totalTracer = TracerStudy::count();

        $statusData = TracerStudy::select('status')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('status')
            ->get();

        $statusLabels = $statusData->pluck('status')->toArray();
        $statusCounts = $statusData->pluck('count')->toArray();

        $majorData = AlumniProfile::select('major')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('major')
            ->get();

        $majorLabels = $majorData->pluck('major')->toArray();
        $majorCounts = $majorData->pluck('count')->toArray();

        $avgSalary = TracerStudy::where('status', 'working')->avg('salary') ?? 0;
        $avgRelevance = TracerStudy::avg('job_relevance') ?? 0;
        $avgWaiting = TracerStudy::avg('waiting_time') ?? 0;

        return view('admin.analytics', compact(
            'totalAlumni',
            'totalTracer',
            'statusLabels',
            'statusCounts',
            'majorLabels',
            'majorCounts',
            'avgSalary',
            'avgRelevance',
            'avgWaiting'
        ));
    }
}