@extends('layouts.admin')

@section('title', 'Riwayat Penumpang')

@section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Riwayat Penumpang Travel</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    @foreach ($groupedTravels as $group)
                        <tr class="bg-dark text-white">
                            <th colspan="4" class="align-middle">
                                {{ $group['jadwal']->nama ?? '-' }} - {{ $group['jadwal']->tujuan ?? '-' }}
                            </th>
                            <th class="align-middle text-center" style="width: 15%;">
                                Kuota ({{ $group['jadwal']->jumlah_kuota ?? '-' }})
                            </th>
                            <th class="align-middle text-center">
                                Tersisa ({{ $group['jadwal']->jumlah_kuota - $group['jadwal']->pemesanan->sum('jumlah_tiket') ?? '-' }})
                            </th>
                        </tr>
                </thead>
                <tbody class="bg-white">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tiket Dipesan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>

                    @forelse ($group['penumpang'] as $travel)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $travel->user->name ?? '-' }}</td>
                            <td>{{ $travel->user->email ?? '-' }}</td>
                            <td class="text-center">{{ $travel->total_tiket ?? '-' }}</td>
                            <td class="text-center">
                                <form action="{{ route('admin.riwayat.update', $travel->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                                        <option value="menunggu_pembayaran" {{ $travel->status == 'menunggu_pembayaran' ? 'selected' : '' }}>
                                            Menunggu Pembayaran
                                        </option>
                                        <option value="sudah_dibayar" {{ $travel->status == 'sudah_dibayar' ? 'selected' : '' }}>
                                            Sudah Dibayar
                                        </option>
                                        <option value="menunggu_verifikasi" {{ $travel->status == 'menunggu_verifikasi' ? 'selected' : '' }}>
                                            Menunggu Verifikasi
                                        </option>
                                        <option value="Dibatalkan" {{ $travel->status == 'Dibatalkan' ? 'selected' : '' }}>
                                            Dibatalkan
                                        </option>
                                    </select>
                                </form>
                            </td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <div>
                                        <a href="{{ route('admin.riwayat.detail', $travel->id) }}" class="btn btn-secondary mr-1">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                    </div>
                                    @if ($travel->buktiPembayaran)
                                        <a href="{{ Storage::url($travel->buktiPembayaran->file_path) }}" target="_blank" class="btn btn-primary btn-sm mx-1">
                                            <i class="fas fa-image"></i> Lihat Bukti
                                        </a>
                                    @else
                                        <span class="text-muted mx-1">Belum ada bukti</span>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data penumpang.</td>
                        </tr>
                    @endforelse

                </tbody>

                @endforeach
            </table>
        </div>        
    </div>
    
@endsection
