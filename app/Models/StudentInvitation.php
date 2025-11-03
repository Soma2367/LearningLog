<?php

namespace App\Models\Teacher;

use Illuminate\Database\Eloquent\Model;
use App\Models\Teacher;

class StudentInvitation extends Model
{
    protected $fillable = [
        'teacher_id',
        'code',
        'used',
        'used_at',
        'student_id',
    ];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
