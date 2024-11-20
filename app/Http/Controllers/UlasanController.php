<?php

namespace App\Http\Controllers;

use App\Models\Warung;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    /**
     * Display a listing of the ulasan (reviews) for a specific warung.
     *
     * @param  int  $warung_id
     * @return \Illuminate\View\View
     */
    public function index($warung_id)
    {
        // Retrieve the warung and its related ulasan
        $warung = Warung::findOrFail($warung_id);
        $ulasan = $warung->ulasan; // Get all reviews for this warung

        // Return the ulasan view with the reviews, using the correct folder path
        return view('warung.ulasan', compact('warung', 'ulasan'));
    }
    public function store(Request $request, $warung_id)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        // Pastikan warung_id valid
        $warung = Warung::findOrFail($warung_id);

        // Simpan ulasan
        Ulasan::create([
            'user_id' => Auth::id(), // Ambil user_id dari pengguna yang login
            'warung_id' => $warung->warung_id, // Ambil warung_id dari parameter
            'rating' => $request->input('rating'),
            'komentar' => $request->input('komentar'),
        ]);

        // Redirect kembali ke halaman menu dengan pesan sukses
        return redirect()->route('warung.menu', $warung_id)
            ->with('success', 'Ulasan berhasil dikirim.');
    }
    public function lihatUlasan($warung_id)
    {
        // Ambil data warung beserta ulasan terkait
        $warung = Warung::with('ulasan.user')->findOrFail($warung_id);

        // Kirim data ke view
        return view('warung.lihatUlasan', compact('warung'));
    }
}

