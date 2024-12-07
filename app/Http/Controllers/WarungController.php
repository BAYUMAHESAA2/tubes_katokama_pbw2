<?php

namespace App\Http\Controllers;

use App\Models\Warung;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WarungController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $warung = Warung::when($query, function ($q) use ($query) {
            $q->where('nama_warung', 'LIKE', "%{$query}%")
                ->orWhere('alamat', 'LIKE', "%{$query}%")
                ->orWhere('no_wa', 'LIKE', "%{$query}%");
        })->get();

        return view('warung', compact('warung'));
    }

    public function destroy($id)
    {
        $warung = Warung::findOrFail($id);
        $warung->delete();

        return redirect()->route('warung.index')->with('success', 'Warung berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_warung' => 'required|max:100',
            'alamat' => 'nullable|max:255',
            'no_wa' => 'required|max:15',
            'status_pengantaran' => 'required|in:aktif,tidak aktif',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        $warung = new Warung;
        $warung->nama_warung = $validatedData['nama_warung'];
        $warung->slug = Str::slug($validatedData['nama_warung'], '-');
        $warung->alamat = $validatedData['alamat'];
        $warung->no_wa = $validatedData['no_wa'];
        $warung->status_pengantaran = $validatedData['status_pengantaran'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $warung->image = $imageName;
        }

        $warung->save();

        return redirect()->route('warung.index')->with('success', 'Warung berhasil ditambahkan.');
    }

    public function search(Request $request)
    {
        return redirect()->route('warung.index', ['query' => $request->input('search_query')]);
    }

    public function showMenu($id)
    {
        $warung = Warung::with('menu')->findOrFail($id);
        return view('warung.menu', compact('warung'));
    }

    public function addMenu($id)
    {
        $warung = Warung::findOrFail($id);
        return view('warung.add_menu', compact('warung'));
    }

    public function storeMenu(Request $request, $id)
    {
        $warung = Warung::findOrFail($id);

        $request->validate([
            'nama_menu' => 'required|string|max:100',
            'harga' => 'required|numeric',
            'ketersediaan' => 'nullable|in:tersedia,habis',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu_images', 'public');
        }

        $warung->menu()->create([
            'nama_menu' => $request->nama_menu,
            'harga' => $request->harga,
            'ketersediaan' => $request->ketersediaan ?? 'tersedia',
            'image' => $imagePath,
        ]);

        return redirect()->route('warung.showMenu', $warung->warung_id)->with('success', 'Menu berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $warung = Warung::findOrFail($id);
        return view('warung.editWarung', compact('warung'));
    }

    // Method untuk mengupdate data warung
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_warung' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_wa' => 'required|string|max:15',
            'status_pengantaran' => 'required|in:aktif,tidak aktif',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi untuk gambar
        ]);
    
        $warung = Warung::findOrFail($id);
        $warung->nama_warung = $request->nama_warung;
        $warung->alamat = $request->alamat;
        $warung->no_wa = $request->no_wa;
        $warung->status_pengantaran = $request->status_pengantaran;
    
        // Cek apakah gambar diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($warung->image && file_exists(public_path('img/' . $warung->image))) {
                unlink(public_path('img/' . $warung->image));
            }
    
            // Simpan gambar baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $warung->image = $imageName;
        }
    
        $warung->save();
    
        return redirect()->route('warung.index')->with('success', 'Warung berhasil diperbarui!');
    }
    
}
