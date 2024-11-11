<!-- resources/views/warung/menu.blade.php -->
@extends('app')

@section('title', 'Menu ' . $warung->nama_warung)

@section('content')
    <div class="container">
        <h2>Menu di {{ $warung->nama_warung }}</h2>
        <div class="row">
            @foreach ($warung->menu as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Pastikan path gambar sesuai -->
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->nama_menu }}</h5>
                            <p class="card-text">Harga: Rp{{ number_format($menu->harga, 2, ',', '.') }}</p>
                            <p class="card-text">Status: {{ $menu->ketersediaan }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
