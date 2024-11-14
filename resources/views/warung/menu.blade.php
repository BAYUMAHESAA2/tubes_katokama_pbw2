<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Menu</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
    <div class="container">
        <h2>Menu di Warung {{ $warung->nama_warung }}</h2>

        <div class="row-7">
        <div class="col-md-4">
            <div class="card mb-3">
                <img src="{{ $warung->image_url }}" class="card-img-top" alt="{{ $warung->nama_warung }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $warung->nama_warung }}</h5>
                </div>
            </div>
        </div>
        <!-- Tombol untuk menambah menu baru -->
        <a href="{{ route('menu.create', ['warung_id' => $warung->warung_id]) }}" class="btn btn-primary mb-3">
            Tambah Menu
        </a>

        <a href="{{ route('warung.index') }}" class="btn btn-secondary mb-3">
            Kembali
        </a>

    
    
        <!-- Tabel untuk menampilkan data menu -->
         <form id="menuFrom" method="POST" action="{{ route('whatsapp.send') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">pilih</th>
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
                                <input type="checkbox" class="form-check-input" id="menuCheck{{ $loop->index }}" autocomplete="off">
                                <label class="form-check-label" for="menuCheck{{ $loop->index }}"></label>
                            </div>
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</body>
</html>     