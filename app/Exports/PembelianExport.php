<?php

namespace App\Exports;

use App\Models\Pembelian;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PembelianExport implements FromView
{
    private $tanggal_awal;
    private $tanggal_akhir;

    public function __construct($tanggal_awal_export, $tanggal_akhir_export)
    {
        $this->tanggal_awal = $tanggal_awal_export;
        $this->tanggal_akhir = $tanggal_akhir_export;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {

        $data_pembelian = Pembelian::with(['detailPembelians', 'user', 'pemasok'])->whereBetween('tanggal_masuk', [$this->tanggal_awal, $this->tanggal_akhir])->get();

        return view('app.pembelians.export', compact('data_pembelian'));
    }
}
