<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyStudyLog extends Model
{
    protected $guarded = [
        'teacher_feedback'
    ];

    protected $casts = [
        'study_date' => 'date',
        'study_time' => 'string',
        'progress_rating' => 'integer',
    ];

    public function student() {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function hasFeedback(): bool
    {
        return !is_null($this->teacher_feedback);
    }
}
