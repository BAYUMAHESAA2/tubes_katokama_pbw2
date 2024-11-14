<?php

namespace App\Http\Controllers;

use App\Models\Warung;
use Illuminate\Http\Request;

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
}