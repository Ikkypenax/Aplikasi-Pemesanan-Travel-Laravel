@extends('layouts.admin')

@section('title', 'Detail Riwayat')

@section('content')

    <div class="container-fluid">
        <div class="row ml-2">
            <a href="{{ route('admin.riwayat.index') }}" class="btn btn-primary mb-3">
                <i class="fas fa-arrow-left mt-2"></i>
            </a>
            <h1 class="h3 mb-4 ml-3 text-gray-800">Detail Riwayat</h1>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Atas Nama: {{ $travels->user->name }}</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Email</th>
                                <td>{{ $travels->user->email }}</td>
                            </tr>
                            <tr>
                                <th>Nama Travel</th>
                                <td>{{ $travels->jadwalTravel->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tujuan</th>
                                <td>{{ $travels->jadwalTravel->tujuan }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Keberangkatan</th>
                                <td>{{ \Carbon\Carbon::parse($travels->jadwaltravel->tanggal)->translatedFormat('d F Y') }} |
                                    {{ \Carbon\Carbon::parse($travels->jadwaltravel->waktu_berangkat)->format('H:i') }} WIB</td>
                            </tr>
                        </table>
                    </div>

                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Harga Tiket</th>
                                <td>Rp. {{ number_format($travels->jadwalTravel->harga_tiket, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Tiket Dipesan</th>
                                <td>{{ $travels->jumlah_tiket }}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>Rp. {{ number_format($travels->total_harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ ucfirst(str_replace('_', ' ', $travels->status)) }}</td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

            <div class="card-footer text-right">
                <a href="{{ route('admin.riwayat.invoice', $travels->id) }}" class="btn btn-warning">
                    <i class="fas fa-file-pdf"></i> Invoice
                </a>
            </div>
        </div>
    </div>
    
@endsection
