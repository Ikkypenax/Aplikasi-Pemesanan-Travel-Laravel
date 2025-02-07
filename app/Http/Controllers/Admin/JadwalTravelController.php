<?php

namespace App\Http\Controllers\Admin;

use App\Models\JadwalTravel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class JadwalTravelController extends Controller
{
    public function index()
    {
        $jadwalTravels = JadwalTravel::all();
        return view('admin.jadwal_travel.index', compact('jadwalTravels'));
    }
    
    public function create()
    {
        return view('admin.jadwal_travel.create');
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tujuan' => 'required',
            'tanggal' => 'required|date',
            'waktu_berangkat' => 'required',
            'kuota_penumpang' => 'required|integer',
            'jumlah_kuota' => 'required|integer',
            'harga_tiket' => 'required|numeric',
        ]);

        JadwalTravel::create($request->all());

        return redirect()->route('admin.jadwal_travel.index')->with('success', 'Jadwal travel berhasil ditambahkan');
    }
    
    public function edit($id)
    {
        $jadwalTravel = JadwalTravel::findOrFail($id);
        return view('admin.jadwal_travel.edit', compact('jadwalTravel'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'tujuan' => 'required',
            'tanggal' => 'required|date',
            'waktu_berangkat' => 'required',
            'kuota_penumpang' => 'required|integer',
            'jumlah_kuota' => 'required|integer',
            'harga_tiket' => 'required|numeric',
        ]);

        $jadwalTravel = JadwalTravel::findOrFail($id);
        $jadwalTravel->update($request->all());

        return redirect()->route('admin.jadwal_travel.index')->with('success', 'Jadwal travel berhasil diperbarui');
    }
   
    public function destroy($id)
    {
        $jadwalTravel = JadwalTravel::findOrFail($id);
        $jadwalTravel->delete();

        return redirect()->route('admin.jadwal_travel.index')->with('success', 'Jadwal travel berhasil dihapus');
    }
}
