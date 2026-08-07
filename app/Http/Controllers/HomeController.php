<?php

namespace App\Http\Controllers;

use App\Models\CourseSession;
use App\Models\Scholarship;

class HomeController extends Controller
{
    public function index()
    {
        $scholarships = Scholarship::latest()->take(3)->get();
        $sessions = CourseSession::latest()->take(3)->get();

        return view('welcome', compact('scholarships', 'sessions'));
    }
}
