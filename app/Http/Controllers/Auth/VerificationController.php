<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function showVerificationPage($token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user || $user->verification_token_expired_at < now()) {
            return redirect()->route('login')->with('error', 'Token verifikasi tidak valid atau telah kedaluwarsa.');
        }

        return view('auth.verify-code', compact('user'));
    }

    // Memproses verifikasi kode yang dimasukkan
    public function verifyEmail(Request $request, $token)
    {
        $request->validate([
            'verification_code' => 'required|numeric|digits:6', // Pastikan kode terdiri dari 6 angka
        ]);

        $user = User::where('verification_token', $token)->first();

        if (!$user || $user->verification_token_expired_at < now()) {
            return redirect()->route('login')->with('error', 'Token verifikasi tidak valid atau telah kedaluwarsa.');
        }

        if ($request->verification_code == $user->verification_token) {
            $user->email_verified = true;
            $user->verification_token = null; // Hapus token setelah verifikasi
            $user->save();

            return redirect()->route('login')->with('success', 'Akun Anda berhasil diverifikasi. Silakan login.');
        } else {
            return back()->withErrors(['verification_code' => 'Kode verifikasi salah.']);
        }
    }

}
