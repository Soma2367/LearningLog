<?php

namespace App\Http\Controllers;

use App\Models\DailyStudyLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyStudyLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('student.daily_study_logs.index');
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
        //
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
