<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Opsional (buat dashboard informatif)
        $totalProduk   = Product::count();
        $userAktif     = User::where('status', 1)->count();
        $recentProducts = Product::latest()->take(5)->get();

        return view('dashboard.index', compact('user', 'totalProduk', 'userAktif', 'recentProducts'));
    }
}
