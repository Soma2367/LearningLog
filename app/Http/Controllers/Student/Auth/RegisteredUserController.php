<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Teacher\StudentInvitation;
use App\Models\Student;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('student.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
        public function store(Request $request): RedirectResponse
        {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],  // ✅ users テーブル
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'invitation_code' => ['required', 'string'],
        ]);

        $invitation = StudentInvitation::where('code', $request->invitation_code)
            ->where('used', false)
            ->first();

        if (!$invitation) {
            return back()->withErrors([
                'invitation_code' => '無効または使用済みの招待コードです'
            ])->onlyInput('invitation_code');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'teacher_id' => $invitation->teacher_id,
        ]);

        $invitation->update([
            'used' => true,
            'used_at' => now(),
            'student_id' => $student->id,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('student.dashboard');
        }
    }
