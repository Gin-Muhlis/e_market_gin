<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rombel extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['rombel'];

    protected $searchableFields = ['*'];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
