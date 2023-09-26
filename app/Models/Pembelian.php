<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembelian extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_masuk',
        'tanggal_masuk',
        'total',
        'pemasok_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function pemasok()
    {
        return $this->belongsTo(Pemasok::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detailPembelians()
    {
        return $this->hasMany(DetailPembelian::class);
    }
}
