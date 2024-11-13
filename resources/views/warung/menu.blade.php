@extends('app')

@section('title', 'Menu ' . $warung->nama_warung)

@section('content')
    <div class="container">
        <h2>Menu di {{ $warung->nama_warung }}</h2>

        <!-- Tombol untuk menambah menu baru -->
        <a href="{{ route('menu.create', ['warung_id' => $warung->warung_id]) }}" class="btn btn-primary mb-3">
            Tambah Menu
        </a>


        <!-- Tabel untuk menampilkan data menu -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Makanan & Minuman</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Ketersediaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($warung->menu as $menu)
                    <tr>
                        <td>{{ $menu->nama_menu }}</td>
                        <td>Rp{{ number_format($menu->harga, 2, ',', '.') }}</td>
                        <td>{{ $menu->ketersediaan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
