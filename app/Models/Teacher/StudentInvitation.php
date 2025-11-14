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

    public static function generateCode(int $length = 6): string
    {
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $maxIndex = strlen($chars) - 1;

        do {
            $code = '';
            for($i = 0; $i < $length; $i++) {
                $code .= $chars[random_int(0, $maxIndex)];
            }
        } while (self::where('code', $code)->exists());

        return $code;
    }
}
