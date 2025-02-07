<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPembayaran extends Model
{
    protected $table = 'bukti_pembayaran';

    protected $fillable = ['pemesanan_id', 'file_path'];
    public function pesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}
