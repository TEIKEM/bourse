<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CourseEnrollmentController;
use App\Http\Controllers\CourseSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ScholarshipApplicationController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ScholarshipController as AdminScholarshipController;
use App\Http\Controllers\Admin\CourseSessionController as AdminCourseSessionController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ScholarshipApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\CourseEnrollmentController as AdminEnrollmentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\StudentDocumentController;
use App\Http\Controllers\StudentProfileController;

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Formulaire d'évaluation / Candidature
Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');

// Routes d'Authentification (Invités uniquement)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Routes protégées (Utilisateurs connectés)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/bourses', [ScholarshipController::class, 'index'])->name('scholarships.index');
Route::get('/bourses/{scholarship}', [ScholarshipController::class, 'show'])->name('scholarships.show');
Route::get('/cours-de-langues', [CourseSessionController::class, 'index'])->name('language-courses.index');
Route::get('/cours-de-langues/{courseSession}', [CourseSessionController::class, 'show'])->name('language-courses.show');
Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

Route::middleware('auth')->group(function () {

    // Point d'entrée unique (utilisé par la navbar) : redirige selon le rôle
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/mon-espace/profil', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
Route::put('/mon-espace/profil', [StudentProfileController::class, 'update'])->name('student.profile.update');

Route::get('/mon-espace/documents', [StudentDocumentController::class, 'index'])->name('student.documents.index');
Route::put('/mon-espace/documents/{document}', [StudentDocumentController::class, 'update'])->name('student.documents.update');
Route::delete('/mon-espace/documents/{document}', [StudentDocumentController::class, 'destroy'])->name('student.documents.destroy');

Route::delete('/bourses/{scholarship}/postuler', [ScholarshipApplicationController::class, 'destroy'])->name('scholarships.apply.destroy');
Route::delete('/cours-de-langues/{courseSession}/inscription', [CourseEnrollmentController::class, 'destroy'])->name('courses.enroll.destroy');


    // Dashboard étudiant
    Route::get('/mon-espace', [StudentDashboardController::class, 'index'])->name('student.dashboard');

    // Dashboard admin (protégé en plus par le middleware 'admin')
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });

});

Route::middleware('auth')->group(function () {
    Route::get('/bourses/{scholarship}/postuler', [ScholarshipApplicationController::class, 'create'])->name('scholarships.apply');
    Route::post('/bourses/{scholarship}/postuler', [ScholarshipApplicationController::class, 'store'])->name('scholarships.apply.store');

    Route::get('/cours-de-langues/{courseSession}/inscription', [CourseEnrollmentController::class, 'create'])->name('courses.enroll');
    Route::post('/cours-de-langues/{courseSession}/inscription', [CourseEnrollmentController::class, 'store'])->name('courses.enroll.store');
});

/*
    Remplace le bloc admin existant dans routes/web.php par celui-ci
    (il contient déjà la route admin.dashboard + les 3 nouvelles ressources CRUD) :
*/




Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');

    Route::resource('scholarships', AdminScholarshipController::class)->except(['show']);
    Route::patch('/scholarships/{scholarship}/increase-capacity', [AdminScholarshipController::class, 'increaseCapacity'])->name('scholarships.increase-capacity');

    Route::resource('courses', AdminCourseSessionController::class)->except(['show']);
    Route::patch('/courses/{course}/increase-capacity', [AdminCourseSessionController::class, 'increaseCapacity'])->name('courses.increase-capacity');

    Route::resource('services', AdminServiceController::class)->except(['show']);

    Route::get('/applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('/applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    Route::patch('/applications/{application}/status', [AdminApplicationController::class, 'updateStatus'])->name('applications.update-status');

    Route::get('/enrollments', [AdminEnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('/enrollments/{enrollment}', [AdminEnrollmentController::class, 'show'])->name('enrollments.show');
    Route::patch('/enrollments/{enrollment}/status', [AdminEnrollmentController::class, 'updateStatus'])->name('enrollments.update-status');

});
