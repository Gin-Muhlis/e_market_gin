<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'no_faktur',
        'tgl_faktur',
        'total_bayar',
        'pelanggan_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tgl_faktur' => 'date',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPenjualans()
    {
        return $this->hasMany(DetailPenjualan::class);
    }

    public function tampungBayars()
    {
        return $this->hasMany(TampungBayar::class);
    }
}
