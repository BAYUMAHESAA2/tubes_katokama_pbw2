<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
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
        </div>
    </nav>
    <div class="container">
        <!-- SweetAlert untuk pesan sukses -->
        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            </script>
        @endif

        <h2>Menu di Warung {{ $warung->nama_warung }}</h2>

        <!-- Row with two columns: left for card, right for menu -->
        <div class="row">
            <!-- Left column for card -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $warung->warung_id }}">
                        <img src="{{ asset('img/' . $warung->image) }}" class="card-img-top img-fluid"
                            alt="{{ $warung->nama_warung }}">
                    </a>
                    <div class="card-body">
                        @auth
                            @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('User'))
                                <a href="{{ route('ulasan.index', ['warung_id' => $warung->warung_id]) }}"
                                    class="btn btn-success mb-3">Berikan Penilaian</a>
                            @endif
                        @endauth
                        <a href="{{ route('ulasan.lihatUlasan', ['warung_id' => $warung->warung_id]) }}"
                            class="btn btn-success mb-3">Lihat ulasan</a>
                    </div>
                </div>
            </div>

            <!-- Right column for menu items -->
            <div class="col-md-8">
                @auth
                    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Warung'))
                        <a href="{{ route('menu.create', ['warung_id' => $warung->warung_id]) }}"
                            class="btn btn-primary mb-3">Tambah Menu</a>
                    @endif
                @endauth

                <form id="menuForm" method="POST" action="{{ route('whatsapp.send') }}">
                    @csrf
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Pilih</th>
                                <th scope="col">Makanan & Minuman</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Ketersediaan</th>
                                @auth
                                    @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Warung'))
                                        <th scope="col">Edit & Hapus</th>
                                    @endif
                                @endauth
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warung->menu as $menu)
                                <tr>
                                    <td>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="selected_menu[]"
                                                value="{{ $menu->id }}" id="menuCheck{{ $loop->index }}"
                                                autocomplete="off">
                                            <label class="form-check-label" for="menuCheck{{ $loop->index }}"></label>
                                        </div>
                                    </td>
                                    <td>{{ $menu->nama_menu }}</td>
                                    <td>Rp{{ number_format($menu->harga, 2, ',', '.') }}</td>
                                    <td>{{ $menu->ketersediaan }}</td>
                                    @auth
                                        @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Warung'))
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('menu.edit', ['warung' => $warung->warung_id, 'menu' => $menu->menu_id]) }}"
                                                        class="btn btn-warning btn-sm me-2">
                                                        <i class="bi bi-pencil"></i> Edit
                                                    </a>
                                                    <form id="delete-form-{{ $menu->menu_id }}"
                                                        action="{{ route('menu.destroy', ['warung' => $warung->warung_id, 'menu' => $menu->menu_id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $menu->menu_id }})">
                                                            <i class="bi bi-trash"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        @endif
                                    @endauth
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
    <div class="modal fade" id="imageModal-{{ $warung->warung_id }}" tabindex="-1"
        aria-labelledby="imageModalLabel-{{ $warung->warung_id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src="{{ asset('img/' . $warung->image) }}" class="img-fluid"
                        alt="{{ $warung->nama_warung }}">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(menuId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Menu yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + menuId).submit();
                }
            });
        }
    </script>
</body>

</html>