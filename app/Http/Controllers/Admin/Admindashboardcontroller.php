<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseEnrollment;
use App\Models\CourseSession;
use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'students' => User::where('role', 'student')->count(),
            'scholarships' => Scholarship::count(),
            'courses' => CourseSession::count(),
            'pending_applications' => ScholarshipApplication::where('status', 'pending')->count(),
            'pending_enrollments' => CourseEnrollment::where('status', 'pending')->count(),
        ];

        $recentApplications = ScholarshipApplication::with(['user', 'scholarship'])
            ->latest()
            ->limit(5)
            ->get();

        $recentEnrollments = CourseEnrollment::with(['user', 'courseSession'])
            ->latest()
            ->limit(5)
            ->get();

        return view('dashboard.admin', compact('stats', 'recentApplications', 'recentEnrollments'));
    }
}
