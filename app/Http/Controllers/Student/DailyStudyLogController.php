<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\DailyStudyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\StudyLogService;

class DailyStudyLogController extends Controller
{
    public function __construct(private StudyLogService $studyLogService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentId = Auth::id();

        $logs = $this->studyLogService->getStudentLogs($studentId, perPage: 6);
        $total = $this->studyLogService->calculateTotalStudyTime($studentId);
        $totalHour = $total['hour'];
        $remainingMin = $total['min'];

        $consecutiveDays = $this->studyLogService->calculateConsecutiveDays($studentId);

        return view('student.daily_study_logs.index', compact('logs', 'totalHour', 'remainingMin','consecutiveDays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('student.daily_study_logs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required | string | max:30',
            'content' => 'required | string | max:600',
            'study_time' => 'required',
            'study_date' => 'required',
            'progress_rating' => 'required | integer | min:1 | max:5',
        ]);

        $validated['student_id'] = Auth::id();

        $log = DailyStudyLog::create($validated);

        return redirect()->route('student.daily_study_logs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $logs = DailyStudyLog::where('student_id', Auth::id());
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
