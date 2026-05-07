<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\TracerStudy;

class AlumniController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $tracer = $user->tracerStudy;

        return view('alumni.dashboard', compact('user', 'tracer'));
    }

    public function profile()
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        return view('alumni.profile', compact('user', 'profile'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $profile = $user->alumniProfile;

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'graduation_year' => 'required|integer|min:2000|max:' . date('Y'),
            'major' => 'required|string|max:255',
        ]);

        $user->update([
            'name' => $validated['name'],
        ]);

        $profile->update([
            'graduation_year' => $validated['graduation_year'],
            'major' => $validated['major'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ]);

        return redirect()->route('alumni.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}