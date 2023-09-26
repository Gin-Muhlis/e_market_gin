<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisPembayaran extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['nama'];

    protected $searchableFields = ['*'];

    protected $table = 'jenis_pembayarans';

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}
