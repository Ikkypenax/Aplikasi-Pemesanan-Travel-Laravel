@extends('layouts.penumpang')

@section('title', 'Detail Riwayat')

@section('content')

    <div class="container-fluid">
        <div class="row ml-2">
            <a href="{{ route('penumpang.pesanan.index') }}" class="btn btn-primary mb-3">
                <i class="fas fa-arrow-left mt-2"></i>
            </a>
            <h1 class="h3 mb-4 ml-3 text-gray-800">Detail Riwayat</h1>
        </div>

        <div class="container mt-4">
            <div class="card shadow">
                
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">{{ $pesanans->user->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6">
                            <p><strong>Email:</strong> {{ $pesanans->user->email }}</p>
                            <p><strong>Nama Travel:</strong> {{ $pesanans->jadwalTravel->nama }}</p>
                            <p><strong>Tujuan:</strong> {{ $pesanans->jadwalTravel->tujuan }}</p>
                            <p><strong>Waktu Keberangkatan:</strong> 
                                {{ \Carbon\Carbon::parse($pesanans->jadwalTravel->tanggal)->translatedFormat('d F Y') }} |
                                    {{ \Carbon\Carbon::parse($pesanans->jadwalTravel->waktu_berangkat)->format('H:i') }} WIB
                            </p>
                        </div>

                        <div class="col-md-6">
                            <p><strong>Harga Tiket:</strong> Rp. {{ number_format($pesanans->jadwalTravel->harga_tiket, 0, ',', '.') }}</p>
                            <p><strong>Jumlah Tiket Dipesan:</strong> {{ $pesanans->jumlah_tiket }}</p>
                            <p><strong>Total:</strong> Rp. {{ number_format($pesanans->total_harga, 0, ',', '.') }}</p>
                            <p><strong>Status:</strong> 
                                @switch($pesanans->status)
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
                                        <span class="badge badge-secondary">{{ $pesanans->status }}</span>
                                @endswitch
                            </p>
                        </div>
                    </div>
                </div>
        
                <div class="card-footer text-center">
                    @switch($pesanans->status)
                        @case('menunggu_pembayaran')
                            <div class="mb-2">
                                <label for="bukti_pembayaran">Silahkan Upload Bukti Pembayaran:</label>
                                <form action="{{ route('penumpang.pesanan.upload', $pesanans->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="bukti_pembayaran" required class="form-control mb-2">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </form>
                            </div>
                        @break
        
                        @case('menunggu_verifikasi')
                            <strong class="text-warning">*Bukti Pembayaran Sedang Diverifikasi</strong>
                        @break
                        
                        @case('sudah_dibayar')
                            <a href="{{ route('penumpang.pesanan.invoice', $pesanans->id) }}" class="btn btn-warning">
                                <i class="fas fa-file-pdf"></i> Cetak Invoice
                            </a>
                            <p class="mt-2 text-success"><strong>*Silahkan Cetak Invoice</strong></p>
                        @break
        
                        @case('Dibatalkan')
                            <p class="text-danger"><strong>Mohon Maaf, Pesanan Anda Kami Batalkan.</strong></p>
                        @break
        
                        @default
                            <span class="badge badge-secondary">{{ $pesanans->status }}</span>
                    @endswitch
                </div>
            </div>
        </div>
    </div>

@endsection
