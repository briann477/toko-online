<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  /**
   * Tampilkan form login.
   */
  public function showLogin()
  {
    return view('auth.login');
  }

  /**
   * Proses login (cek email + password hash + status aktif).
   */
  public function login(Request $request)
  {
    // Validasi input
    $credentials = $request->validate([
      'email'    => ['required', 'email'],
      'password' => ['required'],
    ]);

    // Coba autentikasi (Auth::attempt cek hash password di DB)
    if (Auth::attempt($credentials, $request->boolean('remember'))) {
      $request->session()->regenerate();

      // Ambil user yang baru login
      $user = Auth::user(); // aman, harusnya ada kalau attempt true

      // Tolak jika akun nonaktif / kejadian edge user null
      if (!$user || !$user->status) {
        Auth::logout();
        return back()
          ->withErrors(['email' => 'Akun dinonaktifkan.'])
          ->onlyInput('email');
      }

      return redirect()->intended('/dashboard')->with('success', 'Berhasil login');
    }

    // Gagal login
    return back()
      ->withErrors(['email' => 'Email atau password salah'])
      ->onlyInput('email');
  }

  /**
   * Logout.
   */
  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login')->with('success', 'Berhasil logout');
  }
}
