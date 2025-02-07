@extends('layouts.penumpang')

@section('title', 'Pemesanan')

@section('content')

    <div class="container mt-4">
        <div class="row">

            <div class="col-md-6 mx-auto">
                <div class="card shadow">

                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="mb-0">Pesan Jadwal Travel</h5>
                    </div>

                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('penumpang.pesanan.store') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="jadwal_travel_id">Pilih Jadwal</label>
                                <select name="jadwal_travel_id" class="form-control" id="jadwal_travel_id" required>
                                    <option value=""></option>
                                    @foreach ($jadwalTravels as $jadwal)
                                        <option value="{{ $jadwal->id }}" data-kuota="{{ $jadwal->kuota_penumpang }}">
                                            {{ $jadwal->tujuan }} -
                                            ({{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }})
                                            -
                                            Kuota:
                                            {{ $jadwal->kuota_penumpang }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jumlah_tiket">Jumlah Tiket</label>
                                <input type="number" name="jumlah_tiket" class="form-control" id="jumlah_tiket"
                                    min="1" required>
                            </div>

                            <span id="kuota_tersedia" class="text-muted">Kuota Tersedia: -</span>
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary btn-block">Pesan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let jadwalSelect = document.getElementById("jadwal_travel_id");
            let jumlahTiketInput = document.getElementById("jumlah_tiket");
            let kuotaTersediaSpan = document.getElementById("kuota_tersedia");

            let kuotaAwal = 0;

            jadwalSelect.addEventListener("change", function() {
                let selectedOption = this.options[this.selectedIndex];
                kuotaAwal = parseInt(selectedOption.getAttribute("data-kuota")) || 0;
                kuotaTersediaSpan.innerText = "Kuota Tersedia: " + kuotaAwal;
                jumlahTiketInput.value = "";
            });

            jumlahTiketInput.addEventListener("input", function() {
                let jumlahTiket = parseInt(this.value) || 0;
                let kuotaTersisa = kuotaAwal - jumlahTiket;

                if (kuotaTersisa < 0) {
                    kuotaTersisa = 0;
                }

                kuotaTersediaSpan.innerText = "Kuota Tersedia: " + kuotaTersisa;
            });
        });
    </script>
    
@endsection
