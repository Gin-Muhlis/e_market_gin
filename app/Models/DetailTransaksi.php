<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailTransaksi extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'jumlah_bayar',
        'transaksi_id',
        'jenis_pembayaran_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'detail_transaksis';

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    public function jenisPembayaran()
    {
        return $this->belongsTo(JenisPembayaran::class);
    }
}
