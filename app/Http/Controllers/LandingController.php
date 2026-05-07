<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TracerStudy;

class LandingController extends Controller
{
    public function index()
    {
        // Total alumni (role = alumni)
        $totalAlumni = User::where('role', 'alumni')->count();

        // Statistik dari tracer study
        $totalTracer    = TracerStudy::count();
        $avgWaiting     = TracerStudy::avg('waiting_time') ?? 0;
        $avgRelevance   = TracerStudy::avg('job_relevance') ?? 0;

        // Persentase bekerja
        $working        = TracerStudy::where('status', 'working')->count();
        $workingPct     = $totalTracer > 0 ? round(($working / $totalTracer) * 100) : 0;

        // Distribusi status (untuk progress bar about section)
        $studying       = TracerStudy::where('status', 'studying')->count();
        $entrepreneur   = TracerStudy::where('status', 'entrepreneur')->count();
        $unemployed     = TracerStudy::where('status', 'unemployed')->count();

        $studyingPct      = $totalTracer > 0 ? round(($studying    / $totalTracer) * 100) : 0;
        $entrepreneurPct  = $totalTracer > 0 ? round(($entrepreneur / $totalTracer) * 100) : 0;
        $unemployedPct    = $totalTracer > 0 ? round(($unemployed   / $totalTracer) * 100) : 0;

        return view('landing', compact(
            'totalAlumni',
            'totalTracer',
            'avgWaiting',
            'avgRelevance',
            'workingPct',
            'studyingPct',
            'entrepreneurPct',
            'unemployedPct',
        ));
    }
}