@extends('layouts.admin')

@section('title', 'Jadwal Travel')

@section('content')

    <div class="container-fluid">
        <h1 class="h2 mb-4 text-gray-800">Jadwal Travel</h1>

        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.jadwal_travel.create') }}" class="btn btn-primary mb-3 mr-3">+ Jadwal</a>
        </div>

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
                        <th class="align-top">Nama</th>
                        <th class="align-top">Tujuan</th>
                        <th class="align-top">Tanggal</th>
                        <th class="align-top">Waktu Berangkat</th>
                        <th class="align-top">Kuota Penumpang</th>
                        <th class="align-top">Kuota Tersisa</th>
                        <th class="align-top">Harga Tiket</th>
                        <th class="align-top text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="bg-white">
                    @if ($jadwalTravels->isEmpty())
                        <tr>
                            <td colspan="7" class="text-center text-muted">Travel kosong</td>
                        </tr>
                    @else
                        @foreach ($jadwalTravels as $jadwal)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $jadwal->nama }}</td>
                                <td>{{ $jadwal->tujuan }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($jadwal->waktu_berangkat)->format('H:i') }}
                                    WIB</td>
                                <td class="text-center">{{ $jadwal->jumlah_kuota }}</td>
                                <td class="text-center">{{ $jadwal->kuota_penumpang }}</td>
                                <td>Rp.{{ number_format($jadwal->harga_tiket, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.jadwal_travel.edit', $jadwal->id) }}"
                                        class="btn btn-warning mt-1 pr-2">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.jadwal_travel.destroy', $jadwal->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mt-1">
                                            <i class="fas fa-trash "></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach
                    @endif
                    
                </tbody>
            </table>
        </div>
    </div>

@endsection
