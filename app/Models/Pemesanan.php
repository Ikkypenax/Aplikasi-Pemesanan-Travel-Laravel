<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan';

    protected $primaryKey = 'id';

    protected $fillable = ['jadwal_travel_id', 'user_id', 'jumlah_tiket', 'status'];
    public function jadwalTravel()
    {
        return $this->belongsTo(JadwalTravel::class, 'jadwal_travel_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function buktiPembayaran()
    {
        return $this->hasOne(BuktiPembayaran::class, 'pemesanan_id');
    }
}
