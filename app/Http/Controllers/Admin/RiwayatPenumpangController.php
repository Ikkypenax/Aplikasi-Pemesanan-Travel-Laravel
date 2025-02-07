<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatPenumpangController extends Controller
{
    public function index()
    {
        $travels = Pemesanan::with('jadwaltravel', 'user', 'buktiPembayaran')
            ->selectRaw('MIN(pemesanan.id) as id, pemesanan.jadwal_travel_id, pemesanan.user_id, SUM(pemesanan.jumlah_tiket) as total_tiket, MIN(pemesanan.status) as status')
            ->join('jadwal_travel', 'pemesanan.jadwal_travel_id', '=', 'jadwal_travel.id')
            ->groupBy('pemesanan.jadwal_travel_id', 'pemesanan.user_id', 'jadwal_travel.nama', 'pemesanan.created_at')
            ->orderBy('jadwal_travel.nama', 'ASC')
            ->get();

        $groupedTravels = [];

        foreach ($travels as $travel) {
            $jadwal = $travel->jadwaltravel;
            $travel->jumlah_kuota = $jadwal->jumlah_kuota;
            $travel->sisa_penumpang = $jadwal->jumlah_kuota - $travel->total_tiket;

            if (!isset($groupedTravels[$jadwal->id])) {
                $groupedTravels[$jadwal->id] = [
                    'jadwal' => $jadwal,
                    'penumpang' => []
                ];
            }

            $groupedTravels[$jadwal->id]['penumpang'][] = $travel;
        }

        return view('admin.riwayat.index', compact('groupedTravels'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:menunggu_pembayaran,sudah_dibayar,Dibatalkan',
        ]);

        $travels = Pemesanan::findOrFail($id);

        $travels->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.riwayat.index')->with('success', 'Status pemesanan berhasil diperbarui');
    }

    public function detail(Request $request, $id)
    {
        $travels = Pemesanan::with(['jadwaltravel', 'user'])->findOrFail($id);

        $jadwal = $travels->jadwaltravel;
        $travels->harga = $jadwal->harga_tiket;
        $total_harga = $jadwal->harga_tiket * $travels->jumlah_tiket;

        $travels->total_harga = $total_harga;

        return view('admin.riwayat.detail', compact('travels'));
    }

    public function printInvoice($id)
    {
        $invoice = Pemesanan::with(['jadwaltravel', 'user'])->findOrFail($id);

        $jadwal = $invoice->jadwaltravel;
        $total_harga = $jadwal->harga_tiket * $invoice->jumlah_tiket;
        $invoice->harga = $jadwal->harga_tiket;
        $invoice->total_harga = $total_harga;

        $pdf = PDF::loadView('invoices.invoice', compact('invoice'))->setPaper('A4', 'portrait');

        return $pdf->stream('invoice_' . $invoice->id . '.pdf');
    }
}
