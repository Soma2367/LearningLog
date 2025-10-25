<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\DailyStudyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        $teacher = Auth::user();

        $students = $teacher->students()
            ->withCount('studyLogs')
            ->get();

        return view('teacher.dashboard', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function studentLogs(User $student)
    {
        $teacher = Auth::user();

        if($student->teacher_id !== $teacher->id) {
            abort(403, 'この生徒の記録を閲覧する権限がありません。');
        }

        $logs = $student->studyLogs()
           ->orderBy('study_date', 'desc')
           ->paginate(15);

        return view('teacher.student_logs', compact('student', 'logs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeFeedback(Request $request, DailyStudyLog $log)
    {
        $teacher = Auth::user();

        if($log->student->teacher_id !== $teacher->id) {
            abort(403, 'フィードバック権限がありません。');
        }

        $validated = $request->validate([
            'teacher_feedback' => 'required|string|max:1000',
        ]);

        $log->teacher_feedback = $validated['teacher_feedback'];
        $log->save();

        return redirect()
            ->route('teacher.student.logs', $log->student_id);
    }

    /**
     * Display the specified resource.
     */
    public function showFeedback(DailyStudyLog $log)
    {
        $teacher = Auth::user();
        if($log->student->teacher_id !== $teacher->id) {
            abort(403, '閲覧権限がありません。');
        }

        return view('teacher.feedback', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
