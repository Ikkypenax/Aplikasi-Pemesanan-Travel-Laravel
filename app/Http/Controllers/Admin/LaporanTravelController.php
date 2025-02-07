<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pemesanan;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanTravelController extends Controller
{
    public function index() {
        $travels = Pemesanan::with('jadwaltravel')
            ->selectRaw('jadwal_travel_id, SUM(jumlah_tiket) as total_penumpang')
            ->groupBy('jadwal_travel_id')
            ->get();
    
        return view('admin.laporan.index', compact('travels'));
    }
    
}
