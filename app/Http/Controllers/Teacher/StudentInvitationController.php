<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StudentInvitation;

class StudentInvitationController extends Controller
{
    public function index()
    {
        return view('teacher.invitation.index');
    }
}
