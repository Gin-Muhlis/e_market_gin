<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailTransaksiResource;
use App\Http\Resources\DetailTransaksiCollection;

class TransaksiDetailTransaksisController extends Controller
{
    public function index(
        Request $request,
        Transaksi $transaksi
    ): DetailTransaksiCollection {
        $this->authorize('view', $transaksi);

        $search = $request->get('search', '');

        $detailTransaksis = $transaksi
            ->detailTransaksis()
            ->search($search)
            ->latest()
            ->paginate();

        return new DetailTransaksiCollection($detailTransaksis);
    }

    public function store(
        Request $request,
        Transaksi $transaksi
    ): DetailTransaksiResource {
        $this->authorize('create', DetailTransaksi::class);

        $validated = $request->validate([
            'jumlah_bayar' => ['required', 'numeric'],
            'jenis_pembayaran_id' => [
                'required',
                'exists:jenis_pembayarans,id',
            ],
        ]);

        $detailTransaksi = $transaksi->detailTransaksis()->create($validated);

        return new DetailTransaksiResource($detailTransaksi);
    }
}
