<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPenjualan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'harga_jual',
        'jumlah',
        'sub_total',
        'penjualan_id',
        'barang_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'detail_penjualans';

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
