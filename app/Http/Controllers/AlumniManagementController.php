<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AlumniProfile;
use App\Models\TracerStudy;

class AlumniManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $major = $request->get('major');
        $year = $request->get('year');

        $query = User::where('role', 'alumni')->with(['alumniProfile', 'tracerStudy']);

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('nisn', 'like', "%{$search}%");
            });
        }

        if ($major) {
            $query->whereHas('alumniProfile', function($q) use ($major) {
                $q->where('major', $major);
            });
        }

        if ($year) {
            $query->whereHas('alumniProfile', function($q) use ($year) {
                $q->where('graduation_year', $year);
            });
        }

        $alumni = $query->latest()->paginate(15)->withQueryString();

        $majors = AlumniProfile::distinct()->pluck('major')->toArray();
        $years = AlumniProfile::distinct()->pluck('graduation_year')->toArray();

        return view('admin.alumni.index', compact('alumni', 'majors', 'years'));
    }

    public function show($id)
    {
        $alumni = User::where('role', 'alumni')
            ->with(['alumniProfile', 'tracerStudy'])
            ->findOrFail($id);

        return view('admin.alumni.show', compact('alumni'));
    }

    public function destroy($id)
    {
        $user = User::where('role', 'alumni')->findOrFail($id);

        if ($user->alumniProfile) {
            $user->alumniProfile->delete();
        }

        if ($user->tracerStudy) {
            $user->tracerStudy->delete();
        }

        $user->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Alumni berhasil dihapus.');
    }
}