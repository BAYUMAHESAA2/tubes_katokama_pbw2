<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Warung;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'warung_id' => 'required|exists:warung,warung_id',
            'nama_menu' => 'required|max:100',
            'harga' => 'required|numeric',
            'ketersediaan' => 'required|in:tersedia,habis'
        ]);

        // Simpan data menu
        $menu = new Menu;
        $menu->warung_id = $validatedData['warung_id'];
        $menu->nama_menu = $validatedData['nama_menu'];
        $menu->harga = $validatedData['harga'];
        $menu->ketersediaan = $validatedData['ketersediaan'];
        $menu->save();

        // Redirect kembali ke halaman menu dengan pesan sukses
        return redirect()->route('warung.menu', $menu->warung_id)->with('success', 'Menu berhasil ditambahkan.');
    }

    public function create($warung_id)
    {
        $warung = Warung::findOrFail($warung_id);
        return view('warung.add_menu', compact('warung'));
    }

    public function index(Request $request, $warung_id)
{
    $query = Menu::where('warung_id', $warung_id);

    // Jika ada input pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where('nama_menu', 'like', '%' . $search . '%');
    }

    // Ambil data menu berdasarkan pencarian
    $warung = Warung::findOrFail($warung_id);
    $menus = $query->get();

    // Mengarahkan ke view yang ada di dalam folder warung
    return view('warung.menu', compact('warung', 'menus'));
}






}
