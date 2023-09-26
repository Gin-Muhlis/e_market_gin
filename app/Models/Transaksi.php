<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_transaksi',
        'tgl_bayar',
        'user_input',
        'rombel_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tgl_bayar' => 'date',
    ];

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function rombel()
    {
        return $this->belongsTo(Rombel::class);
    }
}
