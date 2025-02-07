@extends('layouts.admin')

@section('title', 'Tambah Jadwal')

@section('content')

    <div class="container-fluid bg-transparent">
        <div class="row ml-2">
            <a href="{{ route('admin.jadwal_travel.index') }}" class="btn btn-primary mb-3">
                <i class="fas fa-arrow-left mt-2"></i>
            </a>
            <h1 class="h3 mb-4 ml-3 text-gray-800">Tambah Jadwal Travel</h1>
        </div>

        <form action="{{ route('admin.jadwal_travel.store') }}" method="POST">
            @csrf
            <div class="card shadow p-2" style="border-radius: 20px;">
                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" name="nama" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="tujuan">Tujuan</label>
                                <input type="text" class="form-control" name="tujuan" id="tujuan" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_berangkat">Waktu Berangkat</label>
                                <input type="time" class="form-control" name="waktu_berangkat" id="waktu_berangkat"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah_kuota">Kuota Penumpang</label>
                                <input type="number" class="form-control" name="jumlah_kuota" id="jumlah_kuota" required>
                            </div>
                            <div class="form-group">
                                <label for="kuota_penumpang">Kuota Tersisa</label>
                                <input type="number" class="form-control" name="kuota_penumpang" id="kuota_penumpang"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="harga_tiket">Harga Tiket</label>
                                <input type="number" class="form-control" name="harga_tiket" id="harga_tiket" required>
                            </div>
                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('jumlah_kuota').addEventListener('input', function() {
            document.getElementById('kuota_penumpang').value = this.value;
        });
    </script>
@endsection
