<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPembelian extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'harga_beli',
        'jumlah',
        'sub_total',
        'pembelian_id',
        'barang_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'detail_pembelians';

    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
