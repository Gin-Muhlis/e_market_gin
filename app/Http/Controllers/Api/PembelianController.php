<?php

namespace App\Http\Controllers\Api;

use App\Models\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\PembelianResource;
use App\Http\Resources\PembelianCollection;
use App\Http\Requests\PembelianStoreRequest;
use App\Http\Requests\PembelianUpdateRequest;

class PembelianController extends Controller
{
    public function index(Request $request): PembelianCollection
    {
        $this->authorize('view-any', Pembelian::class);

        $search = $request->get('search', '');

        $pembelians = Pembelian::search($search)
            ->latest()
            ->paginate();

        return new PembelianCollection($pembelians);
    }

    public function store(PembelianStoreRequest $request): PembelianResource
    {
        $this->authorize('create', Pembelian::class);

        $validated = $request->validated();

        $pembelian = Pembelian::create($validated);

        return new PembelianResource($pembelian);
    }

    public function show(
        Request $request,
        Pembelian $pembelian
    ): PembelianResource {
        $this->authorize('view', $pembelian);

        return new PembelianResource($pembelian);
    }

    public function update(
        PembelianUpdateRequest $request,
        Pembelian $pembelian
    ): PembelianResource {
        $this->authorize('update', $pembelian);

        $validated = $request->validated();

        $pembelian->update($validated);

        return new PembelianResource($pembelian);
    }

    public function destroy(Request $request, Pembelian $pembelian): Response
    {
        $this->authorize('delete', $pembelian);

        $pembelian->delete();

        return response()->noContent();
    }
}
