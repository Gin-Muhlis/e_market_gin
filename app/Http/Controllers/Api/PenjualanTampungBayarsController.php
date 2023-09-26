<?php

namespace App\Http\Controllers\Api;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TampungBayarResource;
use App\Http\Resources\TampungBayarCollection;

class PenjualanTampungBayarsController extends Controller
{
    public function index(
        Request $request,
        Penjualan $penjualan
    ): TampungBayarCollection {
        $this->authorize('view', $penjualan);

        $search = $request->get('search', '');

        $tampungBayars = $penjualan
            ->tampungBayars()
            ->search($search)
            ->latest()
            ->paginate();

        return new TampungBayarCollection($tampungBayars);
    }

    public function store(
        Request $request,
        Penjualan $penjualan
    ): TampungBayarResource {
        $this->authorize('create', TampungBayar::class);

        $validated = $request->validate([
            'total' => ['required', 'numeric'],
            'terima' => ['required', 'numeric'],
            'kembali' => ['required', 'numeric'],
        ]);

        $tampungBayar = $penjualan->tampungBayars()->create($validated);

        return new TampungBayarResource($tampungBayar);
    }
}
