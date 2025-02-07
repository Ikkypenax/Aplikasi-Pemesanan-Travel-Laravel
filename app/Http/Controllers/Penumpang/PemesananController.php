<?php

namespace App\Http\Controllers\Penumpang;

use App\Models\Pemesanan;
use App\Models\JadwalTravel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BuktiPembayaran;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Silahkan login terlebih dahulu');
        }

        $pesanans = Pemesanan::where('user_id', Auth::id())->get();

        return view('penumpang.index', compact('pesanans'));
    }

    public function create()
    {
        $jadwalTravels = JadwalTravel::where('kuota_penumpang', '>', 0)->get();

        return view('penumpang.create', compact('jadwalTravels'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_travel_id' => 'required|exists:jadwal_travel,id',
            'jumlah_tiket' => 'required|integer|min:1',
        ]);

        $jadwal = JadwalTravel::findOrFail($request->jadwal_travel_id);
        if ($request->jumlah_tiket > $jadwal->kuota_penumpang) {
            return redirect()->back()->with('error', 'Jumlah tiket melebihi kuota tersedia.');
        }

        Pemesanan::create([
            'jadwal_travel_id' => $jadwal->id,
            'user_id' => Auth::id(),
            'jumlah_tiket' => $request->jumlah_tiket,
        ]);

        $jadwal->decrement('kuota_penumpang', $request->jumlah_tiket);

        return redirect()->route('penumpang.pesanan.index')->with('success', 'Pesanan berhasil dibuat');
    }

    public function detail(Request $request, $id)
    {
        $pesanans = Pemesanan::with('jadwaltravel', 'user')->findOrFail($id);

        $jadwal = $pesanans->jadwaltravel;
        $pesanans->harga = $jadwal->harga_tiket;
        $total_harga = $jadwal->harga_tiket * $pesanans->jumlah_tiket;

        $pesanans->total_harga = $total_harga;

        return view('penumpang.detail', compact('pesanans'));
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

    public function uploadBuktiPembayaran(Request $request, $pesananId)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $pesanan = Pemesanan::with('user')->findOrFail($pesananId);
        $userName = str_replace(' ', '_', strtolower($pesanan->user->name)); 
        $fileExtension = $request->file('bukti_pembayaran')->getClientOriginalExtension();
        $fileName = "{$userName}_{$pesanan->id}." . $fileExtension; 

        $filePath = $request->file('bukti_pembayaran')->storeAs('uploads/bukti_pembayaran', $fileName, 'public');

        BuktiPembayaran::create([
            'pemesanan_id' => $pesanan->id,
            'file_path' => $filePath,
        ]);

        $pesanan->update(['status' => 'menunggu_verifikasi']);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
}
