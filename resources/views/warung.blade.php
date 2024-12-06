<x-app-layout>
    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            @auth
                @if (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Warung'))
                    <a href="{{ route('warung.add') }}" class="btn btn-success">Tambah Warung</a>
                @endif
            @endauth
        </div>
        <div class="row">
            @foreach ($warung as $w)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#imageModal-{{ $w->warung_id }}">
                            <img src="{{ asset('img/' . $w->image) }}" class="card-img-top img-fluid"
                                 style="height: 200px; width: 100%; object-fit: cover;" alt="{{ $w->nama_warung }}">
                        </a>
                        <div class="card-body" style="text-align: center; padding: 15px; background-color: #f9f9f9;">
                            <h5 class="card-title">{{ $w->nama_warung }}</h5>
                            <p class="card-text">Alamat: {{ $w->alamat }}</p>
                            <p class="card-text">No. WA: {{ $w->no_wa }}</p>
                            <p class="card-text">Status Pengantaran: {{ $w->status_pengantaran }}</p>
                            <a href="{{ route('warung.menu', $w->warung_id) }}" class="btn btn-warning">Menu</a>
                        </div>
                    </div>
                </div>
    
                <!-- Modal -->
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
</x-app-layout>