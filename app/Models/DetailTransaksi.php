<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_transaksi';
    protected $guarded = [];

    //relasi antara transaksi dan tabel
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id');
    }
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket', 'id');
    }

    public $timestamps = false;
}
