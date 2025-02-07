<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalTravel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'tujuan', 
        'tanggal', 
        'waktu_berangkat', 
        'kuota_penumpang', 
        'jumlah_kuota', 
        'harga_tiket', 
    ];
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'jadwal_travel_id');
    }
    public function users()
    {
        return $this->hasManyThrough(User::class, Pemesanan::class, 'jadwal_travel_id', 'id', 'id', 'user_id');
    }
    
}

