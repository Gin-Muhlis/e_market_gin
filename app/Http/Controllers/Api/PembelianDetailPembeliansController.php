<?php

namespace App\Http\Controllers\Api;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailPembelianResource;
use App\Http\Resources\DetailPembelianCollection;

class PembelianDetailPembeliansController extends Controller
{
    public function index(
        Request $request,
        Pembelian $pembelian
    ): DetailPembelianCollection {
        $this->authorize('view', $pembelian);

        $search = $request->get('search', '');

        $detailPembelians = $pembelian
            ->detailPembelians()
            ->search($search)
            ->latest()
            ->paginate();

        return new DetailPembelianCollection($detailPembelians);
    }

    public function store(
        Request $request,
        Pembelian $pembelian
    ): DetailPembelianResource {
        $this->authorize('create', DetailPembelian::class);

        $validated = $request->validate([
            'harga_beli' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
            'barang_id' => ['required', 'exists:barangs,id'],
        ]);

        $detailPembelian = $pembelian->detailPembelians()->create($validated);

        return new DetailPembelianResource($detailPembelian);
    }
}
