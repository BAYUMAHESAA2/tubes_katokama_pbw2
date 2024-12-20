<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Assign role berdasarkan kebutuhan (default: user)
        $role = $request->input('role', 'user'); // Ambil role dari input atau default ke 'user'
        $user->assignRole($role);

        // Login user setelah registrasi
        Auth::login($user);

        // Redirect berdasarkan role
        if ($user->hasRole('Warung')) {
            // Jika role adalah 'Warung', redirect ke halaman tambah warung
            return redirect()->route('warung.add');
        } elseif ($user->hasRole('admin')) {
            // Redirect ke halaman admin
            return redirect()->route('home');
        } else {
            // Default: Redirect ke halaman user
            return redirect()->route('home');
        }
    }
}
