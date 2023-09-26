<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TampungBayar extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['penjualan_id', 'total', 'terima', 'kembali'];

    protected $searchableFields = ['*'];

    protected $table = 'tampung_bayars';

    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class);
    }
}
