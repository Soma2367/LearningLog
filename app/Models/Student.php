<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'teacher_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function studyLogs()
    {
        return $this->hasMany(DailyStudyLog::class);
    }
}
