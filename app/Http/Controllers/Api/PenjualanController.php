<?php

namespace App\Http\Controllers\Api;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PenjualanResource;
use App\Http\Resources\PenjualanCollection;
use App\Http\Requests\PenjualanStoreRequest;
use App\Http\Requests\PenjualanUpdateRequest;

class PenjualanController extends Controller
{
    public function index(Request $request): PenjualanCollection
    {
        $this->authorize('view-any', Penjualan::class);

        $search = $request->get('search', '');

        $penjualans = Penjualan::search($search)
            ->latest()
            ->paginate();

        return new PenjualanCollection($penjualans);
    }

    public function store(PenjualanStoreRequest $request): PenjualanResource
    {
        $this->authorize('create', Penjualan::class);

        $validated = $request->validated();

        $penjualan = Penjualan::create($validated);

        return new PenjualanResource($penjualan);
    }

    public function show(
        Request $request,
        Penjualan $penjualan
    ): PenjualanResource {
        $this->authorize('view', $penjualan);

        return new PenjualanResource($penjualan);
    }

    public function update(
        PenjualanUpdateRequest $request,
        Penjualan $penjualan
    ): PenjualanResource {
        $this->authorize('update', $penjualan);

        $validated = $request->validated();

        $penjualan->update($validated);

        return new PenjualanResource($penjualan);
    }

    public function destroy(Request $request, Penjualan $penjualan): Response
    {
        $this->authorize('delete', $penjualan);

        $penjualan->delete();

        return response()->noContent();
    }
}
