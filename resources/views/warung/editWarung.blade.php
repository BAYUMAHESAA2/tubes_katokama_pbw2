<x-app-layout>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Warung</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <style>
            .form-group {
                margin-top: 15px;
                margin-bottom: 15px;
            }
            /* Membuat form lebih lebar dan terpusat */
            .form-container {
                max-width: 600px;
                margin: 0 auto; /* Mengatur form berada di tengah */
                padding: 20px;
                background-color: #f8f9fa; /* Warna latar belakang untuk form */
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>

    <body>
        <div class="form-container">
            <h2>Edit Warung</h2>
            <form action="{{ route('warung.update', $warung->warung_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Nama Warung -->
                <div class="form-group">
                    <label for="nama_warung"><b>Nama Warung</b></label>
                    <input type="text" class="form-control" id="nama_warung" name="nama_warung"
                        value="{{ old('nama_warung', $warung->nama_warung) }}" placeholder="Masukkan nama warung" required>
                </div>

                <!-- Alamat -->
                <div class="form-group">
                    <label for="alamat"><b>Alamat</b></label>
                    <input type="text" class="form-control" id="alamat" name="alamat"
                        value="{{ old('alamat', $warung->alamat) }}" placeholder="Masukkan alamat warung">
                </div>

                <!-- Nomor Whatsapp -->
                <div class="form-group">
                    <label for="no_wa"><b>Nomor Whatsapp</b></label>
                    <input type="text" class="form-control" id="no_wa" name="no_wa"
                        value="{{ old('no_wa', $warung->no_wa) }}" placeholder="Masukkan nomor Whatsapp" required>
                </div>

                <!-- Status Pengantaran -->
                <div class="form-group">
                    <label for="status_pengantaran"><b>Status Pengantaran</b></label>
                    <select class="form-control" id="status_pengantaran" name="status_pengantaran" required>
                        <option value="aktif" {{ $warung->status_pengantaran == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ $warung->status_pengantaran == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <!-- Gambar Menu -->
                <div class="form-group">
                    <label for="image"><b>Gambar Menu</b></label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary" style="margin-bottom: 20px;">Update</button>
            </form>
        </div>
    </body>

    </html>
</x-app-layout>
