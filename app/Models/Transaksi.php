<?php

namespace App\Models;

use Egulias\EmailValidator\Result\Reason\DetailedReason;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi extends Model
{
    protected $table = 'tb_transaksi';
    protected $guarded = [];

    protected $attributes = [
        'status' => 'baru', // set status default menjadi 'baru'
    ];
    
    public function detailTransaksi()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi');
    }

    //relasi antara transaksi dan tabel
    public function member() : BelongsTo {
        return $this->belongsTo(Member::class, "id_member", "id");
    }
    public function outlet() : BelongsTo {
        return $this->belongsTo(Outlet::class, "id_outlet", "id");
    }
    public function paket() : BelongsTo {
        return $this->belongsTo(Paket::class, "id_paket", "id");
    }
    public function user() : BelongsTo {
        return $this->belongsTo(User::class, "id_user", "id");
    }

    public function getTotalHargaAttribute()
    {
        return $this->detailTransaksi->sum(function($detail) {
            return $detail->qty * $detail->paket->harga + $detail->biaya_tambahan;
        });
    }

    public function getTotalTagihanAttribute()
    {
        $totalHarga = $this->total_harga;
        $biayaTambahan = $this->biaya_tambahan ?? 0;
        $pajak = $this->pajak ?? 0;
        $diskon = $this->diskon ?? 0;

        return $totalHarga + $biayaTambahan + $pajak - $diskon;
    }

    public $timestamps = false;
}
