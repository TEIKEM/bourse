<?php

namespace Tests\Feature;

use App\Models\CourseEnrollment;
use App\Models\CourseSession;
use App\Models\Scholarship;
use App\Models\ScholarshipApplication;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentCancellationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_can_cancel_pending_course_enrollment(): void
    {
        $user = User::factory()->create();
        $course = CourseSession::factory()->create();
        $enrollment = CourseEnrollment::create([
            'user_id' => $user->id,
            'course_session_id' => $course->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)
            ->delete('/cours-de-langues/' . $course->id . '/inscription');

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseMissing('course_enrollments', ['id' => $enrollment->id]);
    }

    public function test_student_can_cancel_pending_scholarship_application(): void
    {
        $user = User::factory()->create();
        $scholarship = Scholarship::factory()->create();
        $application = ScholarshipApplication::create([
            'user_id' => $user->id,
            'scholarship_id' => $scholarship->id,
            'status' => 'pending',
        ]);

        $response = $this->actingAs($user)
            ->delete('/bourses/' . $scholarship->id . '/postuler');

        $response->assertRedirect('/dashboard');
        $this->assertDatabaseMissing('scholarship_applications', ['id' => $application->id]);
    }
}
