<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher\StudentInvitation;

class StudentInvitationController extends Controller
{
    public function index()
    {
        $teacher = Auth::user()->teacher;
        $invitations = StudentInvitation::where('teacher_id', $teacher->id)
                   ->orderBy('created_at', 'desc')
                   ->get();

        return view('teacher.invitation.index', compact('invitations'));
    }

    public function store(Request $request)
    {
        $teacher = Auth::user()->teacher;
        $code = StudentInvitation::generateCode();

        StudentInvitation::create([
            'teacher_id' => $teacher->id,
            'code' => $code,
            'used' => false,
        ]);

        return redirect()->route('teacher.invitation.index')->with('success', '招待コードを生成しました : '. $code);
    }
}
