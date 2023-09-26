<?php

namespace App\Http\Controllers\Api;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailPenjualanResource;
use App\Http\Resources\DetailPenjualanCollection;

class PenjualanDetailPenjualansController extends Controller
{
    public function index(
        Request $request,
        Penjualan $penjualan
    ): DetailPenjualanCollection {
        $this->authorize('view', $penjualan);

        $search = $request->get('search', '');

        $detailPenjualans = $penjualan
            ->detailPenjualans()
            ->search($search)
            ->latest()
            ->paginate();

        return new DetailPenjualanCollection($detailPenjualans);
    }

    public function store(
        Request $request,
        Penjualan $penjualan
    ): DetailPenjualanResource {
        $this->authorize('create', DetailPenjualan::class);

        $validated = $request->validate([
            'harga_jual' => ['required', 'numeric'],
            'jumlah' => ['required', 'numeric'],
            'sub_total' => ['required', 'numeric'],
            'barang_id' => ['required', 'exists:barangs,id'],
        ]);

        $detailPenjualan = $penjualan->detailPenjualans()->create($validated);

        return new DetailPenjualanResource($detailPenjualan);
    }
}
