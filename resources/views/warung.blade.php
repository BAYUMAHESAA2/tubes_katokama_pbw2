<x-app-layout>
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            @auth
                @if (Auth::user()->hasRole('Admin'))
                    <!-- Admin selalu dapat menambah warung -->
                    <a href="{{ route('warung.add') }}" class="btn btn-success">Tambah Warung</a>
                @elseif (Auth::user()->hasRole('Warung'))
                    <!-- Cek jika pengguna sudah memiliki warung -->
                    @if (!Auth::user()->warung()->exists())
                        <a href="{{ route('warung.add') }}" class="btn btn-success">Tambah Warung</a>
                    @endif
                @endif
            @endauth
        </div>
        <div class="row">
            @foreach ($warung as $w)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Gambar Warung -->
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $w->warung_id }}">
                            <img src="{{ asset('img/' . $w->image) }}" class="card-img-top img-fluid"
                                 style="height: 200px; width: 100%; object-fit: cover;" alt="{{ $w->nama_warung }}">
                        </a>
                        <!-- Informasi Warung -->
                        <div class="card-body" style="text-align: center; padding: 15px; background-color: #f9f9f9;">
                            <h5 class="card-title">{{ $w->nama_warung }}</h5>
                            <p class="card-text">Alamat: {{ $w->alamat }}</p>
                            <p class="card-text">No. WA: {{ $w->no_wa }}</p>
                            <p class="card-text">Status Pengantaran: {{ $w->status_pengantaran }}</p>
                            <a href="{{ route('warung.menu', $w->warung_id) }}" class="btn btn-warning">Menu</a>
                            @auth
                                @if (Auth::user()->hasRole('Admin') || (Auth::user()->hasRole('Warung') && Auth::id() === $w->user_id))
                                    <a href="{{ route('warung.edit', $w->warung_id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('warung.destroy', $w->warung_id) }}" method="POST" style="display: inline-block;" id="deleteForm-{{ $w->warung_id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="deleteWarung({{ $w->warung_id }})">Hapus</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Modal untuk Gambar -->
                <div class="modal fade" id="imageModal-{{ $w->warung_id }}" tabindex="-1"
                     aria-labelledby="imageModalLabel-{{ $w->warung_id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <img src="{{ asset('img/' . $w->image) }}" class="img-fluid" style="width: 100%;" alt="{{ $w->nama_warung }}">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function deleteWarung(warungId) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Warung ini akan dihapus!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm-' + warungId).submit();
                }
            });
        }
    </script>
</x-app-layout>
