<!-- resources/views/warung/add_menu.blade.php -->
@extends('app')

@section('title', 'Tambah Menu')

@section('content')
    <div class="container">
        <h2>Tambah Menu untuk {{ $warung->nama_warung }}</h2>
        <form action="{{ route('warung.menu.store', $warung->warung_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nama_menu" class="form-label">Nama Menu</label>
                <input type="text" class="form-control" id="nama_menu" name="nama_menu" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Tambah Menu</button>
        </form>
    </div>
@endsection
