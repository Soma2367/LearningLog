<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyStudyLog extends Model
{
    protected $guarded = [
        'teacher_feedback',
        'teacher_viewed_at',
    ];
}
