<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .modal-body img {
            width: 100%;
            height: auto;
            object-fit: cover; 
        }
    </style>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a href="{{ route('warung.index') }}" class="btn btn-secondary mb-3">Kembali</a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container">
        @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

        <h2>Menu di Warung {{ $warung->nama_warung }}</h2>
       


        <!-- Row with two columns: left for card, right for menu -->
        <div class="row">
            <!-- Left column for card -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $warung->warung_id }}">
                        <img src="{{ asset('img/' . $warung->image) }}" class="card-img-top img-fluid" alt="{{ $warung->nama_warung }}">
                    </a>
                    <div class="card-body">
                        <a href="{{ route('ulasan.index', ['warung_id' => $warung->warung_id]) }}" class="btn btn-success mb-3">Berikan Penilaian</a>
                        <a href="{{ route('ulasan.lihatUlasan', ['warung_id' => $warung->warung_id]) }}" class="btn btn-success mb-3">Lihat ulasan</a>

                    </div>
                </div>
            </div>

            <!-- Right column for menu items -->
            <div class="col-md-8">
                <a href="{{ route('menu.create', ['warung_id' => $warung->warung_id]) }}" class="btn btn-primary mb-3">Tambah Menu</a>
    
                <form id="menuForm" method="POST" action="{{ route('whatsapp.send') }}">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Pilih</th>
                                <th scope="col">Makanan & Minuman</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ketersediaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warung->menu as $menu)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="selected_menu[]" value="{{ $menu->id }}" id="menuCheck{{ $loop->index }}" autocomplete="off">
                                            <label class="form-check-label" for="menuCheck{{ $loop->index }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $menu->nama_menu }}</td>
                                    <td>Rp{{ number_format($menu->harga, 2, ',', '.') }}</td>
                                    <td>{{ $menu->ketersediaan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-success">Pesan via Whatsapp</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for displaying image in full view -->
    <div class="modal fade" id="imageModal-{{ $warung->warung_id }}" tabindex="-1" aria-labelledby="imageModalLabel-{{ $warung->warung_id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src="{{ asset('img/' . $warung->image) }}" class="img-fluid" alt="{{ $warung->nama_warung }}">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>