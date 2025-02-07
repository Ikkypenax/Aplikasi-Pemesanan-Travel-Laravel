@extends('layouts.admin')

@section('title', 'Laporan Travel')

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Laporan Travel</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th class="align-top text-center">No</th>
                        <th class="align-top">Nama Travel</th>
                        <th class="align-top">Tujuan</th>
                        <th class="align-top">Tanggal Keberangkatan</th>
                        <th class="align-top">Waktu Berangkat</th>
                        <th class="align-top">Kuota Penumpang</th>
                        <th class="align-top">Jumlah Penumpang</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @if ($travels->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted">Laporan kosong</td>
                        </tr>
                    @else
                        @foreach ($travels as $travel)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $travel->jadwaltravel->nama }}</td>
                                <td>{{ $travel->jadwaltravel->tujuan }}</td>
                                <td>{{ \Carbon\Carbon::parse($travel->jadwaltravel->tanggal)->translatedFormat('d F Y') }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::parse($travel->jadwaltravel->waktu_berangkat)->format('H:i') }} WIB
                                </td>
                                <td class="text-center">{{ $travel->jadwaltravel->jumlah_kuota }}</td>
                                <td class="text-center">{{ $travel->total_penumpang }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    
@endsection
