<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyStudyLog extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'content',
        'study_time',
        'study_date',
        'progress_rating',
        'teacher_feedback',
    ];

    protected $casts = [
        'study_time' => 'string',
        'study_date' => 'date',
        'progress_rating' => 'integer',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function hasFeedback(): bool
    {
        return !is_null($this->teacher_feedback);
    }
}
