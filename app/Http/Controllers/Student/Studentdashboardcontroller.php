<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class StudentDashboardController extends Controller
{
    public function index(): View
    {
        $applications = auth()->user()->scholarshipApplications()->with('scholarship')->latest()->get();
        $enrollments = auth()->user()->courseEnrollments()->with('courseSession')->latest()->get();

        return view('dashboard.student', compact('applications', 'enrollments'));
    }
}
