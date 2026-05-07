<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TracerStudy;

class TracerStudyController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $tracer = $user->tracerStudy;

        return view('tracer.create', compact('tracer'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:working,studying,entrepreneur,unemployed',
            'company_name' => 'nullable|string|max:255',
            'job_position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'waiting_time' => 'required|integer|min:0',
            'job_relevance' => 'required|integer|min:1|max:5',
            'university_name' => 'nullable|string|max:255',
            'study_major' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'feedback' => 'nullable|string',
        ]);

        $tracer = TracerStudy::create([
            'user_id' => Auth::id(),
            'status' => $validated['status'],
            'company_name' => $validated['company_name'] ?? null,
            'job_position' => $validated['job_position'] ?? null,
            'salary' => $validated['salary'] ?? null,
            'waiting_time' => $validated['waiting_time'],
            'job_relevance' => $validated['job_relevance'],
            'university_name' => $validated['university_name'] ?? null,
            'study_major' => $validated['study_major'] ?? null,
            'level' => $validated['level'] ?? null,
            'feedback' => $validated['feedback'] ?? null,
        ]);

        return redirect()->route('alumni.dashboard')->with('success', 'Data tracer study berhasil disimpan.');
    }

    public function edit()
    {
        $user = Auth::user();
        $tracer = $user->tracerStudy;

        if (!$tracer) {
            return redirect()->route('tracer.create')->with('error', 'Data tracer study belum ada.');
        }

        return view('tracer.edit', compact('tracer'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $tracer = $user->tracerStudy;

        if (!$tracer) {
            return redirect()->route('tracer.create')->with('error', 'Data tracer study belum ada.');
        }

        $validated = $request->validate([
            'status' => 'required|in:working,studying,entrepreneur,unemployed',
            'company_name' => 'nullable|string|max:255',
            'job_position' => 'nullable|string|max:255',
            'salary' => 'nullable|numeric|min:0',
            'waiting_time' => 'required|integer|min:0',
            'job_relevance' => 'required|integer|min:1|max:5',
            'university_name' => 'nullable|string|max:255',
            'study_major' => 'nullable|string|max:255',
            'level' => 'nullable|string|max:255',
            'feedback' => 'nullable|string',
        ]);

        $tracer->update($validated);

        return redirect()->route('alumni.dashboard')->with('success', 'Data tracer study berhasil diperbarui.');
    }
}