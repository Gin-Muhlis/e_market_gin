<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama_produk'];

    protected $searchableFields = ['*'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
