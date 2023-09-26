<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'kode_pelanggan',
        'nama',
        'alamat',
        'no_telp',
        'email',
    ];

    protected $searchableFields = ['*'];

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class);
    }
}
