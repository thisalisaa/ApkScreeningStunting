<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Posyandu;
use App\Models\Puskesmas;
use App\Mail\EmailVerificationMail;

class DataUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        // Pencarian berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        $perPage = $request->input('per_page', 5);

        $users = $query->with(['puskesmas', 'posyandu'])->paginate($perPage)->withQueryString();

        return view('pages.Admin.DataUser.index', compact('users'));
    }
    public function create()
    {
        $puskesmas = Puskesmas::all();
        $posyandu = Posyandu::all();

        return view('pages.Admin.DataUser.create', compact('puskesmas', 'posyandu'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,petugas_puskesmas,petugas_posyandu',
            'nama' => 'required|string|max:255',
            'id_puskesmas' => 'nullable|exists:puskesmas,id',
            'id_posyandu' => 'nullable|exists:posyandus,id',
        ]);

        $user = User::create([
            'email' => $validated['email'],
            'password' => '@password123!',
            'role' => $validated['role'],
            'nama' => $validated['nama'],
            'id_puskesmas' => $validated['id_puskesmas'] ?? null,
            'id_posyandu' => $validated['id_posyandu'] ?? null,
            'verification_token' => str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT),
            'verification_token_expired_at' => now()->addHours(24),
            'email_verified' => false,
        ]);

        Mail::to($user->email)->send(new EmailVerificationMail($user, $user->verification_token));

        return redirect()->route('admin.data-user')->with('success', 'Akun telah dibuat, silakan cek email Anda untuk verifikasi.');
    }
}
