@extends('layouts.penumpang')

@section('title', 'Riwayat Pesanan')

@section('content')

<h1 class="h3 mb-4 ml-3 text-gray-800">Riwayat Pesanan</h1>
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($pesanans->isEmpty())
            <div class="alert alert-warning text-center">Tidak ada pesanan yang ditemukan.</div>
        @else

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        
                        <table class="table table-bordered">
                            <thead class="bg-dark text-white text-center">
                                <tr>
                                    <th class="align-top">Nama Travel</th>
                                    <th class="align-top">Tujuan</th>
                                    <th class="align-top">Tanggal</th>
                                    <th class="align-top">Waktu Berangkat</th>
                                    <th class="align-top">Status</th>
                                    <th class="align-top">Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pesanans as $pesanan)
                                    <tr class="text-center">
                                        <td>{{ $pesanan->jadwalTravel->nama }}</td>
                                        <td>{{ $pesanan->jadwalTravel->tujuan }}</td>
                                        <td>{{ \Carbon\Carbon::parse($pesanan->jadwalTravel->tanggal)->translatedFormat('d F Y') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($pesanan->jadwalTravel->waktu_berangkat)->format('H:i') }}
                                            WIB</td>
                                        <td>
                                            @switch($pesanan->status)
                                                @case('menunggu_pembayaran')
                                                    <span class="badge badge-warning">Menunggu Pembayaran</span>
                                                @break

                                                @case('sudah_dibayar')
                                                    <span class="badge badge-success">Sudah Dibayar</span>
                                                @break

                                                @case('Dibatalkan')
                                                    <span class="badge badge-danger">Dibatalkan</span>
                                                @break

                                                @case('menunggu_verifikasi')
                                                    <span class="badge badge-secondary">Menunggu Verifikasi</span>
                                                @break

                                                @default
                                                    <span class="badge badge-secondary">{{ $pesanan->status }}</span>
                                            @endswitch
                                        </td>
                                        <td>
                                            <a href="{{ route('penumpang.pesanan.detail', $pesanan->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-info-circle"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
