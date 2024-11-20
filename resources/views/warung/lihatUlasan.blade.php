<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Warung</title>
    
    <!-- Link CSS Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="card-title">Ulasan untuk {{ $warung->nama_warung }}</h2>
        </div>
        <div class="card-body">
            @if ($warung->ulasan->isEmpty())
                <div class="alert alert-warning" role="alert">
                    Belum ada ulasan untuk warung ini.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Pengguna</th>
                                <th>Rating</th>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($warung->ulasan as $ulasan)
                                <tr>
                                    <td>{{ $ulasan->user->name }}</td>
                                    <td>
                                        <span class="badge bg-success">{{ $ulasan->rating }} / 5</span>
                                    </td>
                                    <td>{{ $ulasan->komentar }}</td>
                                    <td>{{ $ulasan->created_at->format('d-m-Y H:i') }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('warung.menu', $warung->warung_id) }}" class="btn btn-secondary">
                Kembali ke Menu
            </a>
        </div>
    </div>
</div>

<!-- Script JS Bootstrap 5.3 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
