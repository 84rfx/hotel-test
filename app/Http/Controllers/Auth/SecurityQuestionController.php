<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SecurityQuestionController extends Controller
{
    public function showSecurityQuestionForm()
    {
        return view('auth.security-question');
    }

    public function verifySecurityQuestion(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'security_answer' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user->security_question || !$user->security_answer) {
            return back()->withErrors(['email' => 'Akun ini tidak memiliki pertanyaan keamanan yang disetel.']);
        }

        if (strtolower(trim($request->security_answer)) !== strtolower(trim($user->security_answer))) {
            return back()->withErrors(['security_answer' => 'Jawaban pertanyaan keamanan salah.']);
        }

        // Store user email in session for password reset
        session(['reset_email' => $user->email]);

        return redirect()->route('password.reset.form');
    }

    public function showResetPasswordForm()
    {
        if (!session('reset_email')) {
            return redirect()->route('login');
        }

        return view('auth.reset-password-security');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $email = session('reset_email');
        if (!$email) {
            return redirect()->route('login');
        }

        $user = User::where('email', $email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        session()->forget('reset_email');

        return redirect()->route('login')->with('success', 'Password berhasil direset. Silakan login dengan password baru.');
    }
}
