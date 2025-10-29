<?php

namespace App\Services;

use App\Models\DailyStudyLog;
use Illuminate\Pagination\LengthAwarePaginator;

class StudyLogService
{
    public function getStudentLogs(int $studentId, int $perPage = 6): LengthAwarePaginator
    {
        return DailyStudyLog::where('student_id', $studentId)
            ->orderBy('study_date', 'desc')
            ->paginate($perPage);
    }

    public function calculateTotalStudyTime(int $studentId): array
    {
        $logs = DailyStudyLog::where('student_id', $studentId)->get();

        $totalMin = $logs->sum(function ($log) {
            $time = explode(':', $log->study_time);
            return (int) $time[0] * 60 + (int) $time[1];
        });

        return [
            'hour' => (int) floor($totalMin / 60),
            'min' => $totalMin % 60,
            'totalMin' => $totalMin,
        ];
    }

    public function calculateConsecutiveDays(int $studentId): int
    {
        $consecutiveDays = 0;
        $checkDate = now()->startOfDay();
        $sortedLogs = DailyStudyLog::where('student_id', $studentId)
            ->orderBy('study_date', 'desc')
            ->get();

        foreach ($sortedLogs as $log) {
            $studyDate = \Carbon\Carbon::parse($log->study_date)->startOfDay();

            if ($studyDate->equalTo($checkDate)) {
                $consecutiveDays++;
                $checkDate = $checkDate->copy()->subDay();
            } else {
                break;
            }
        }

        return $consecutiveDays;
    }
}
