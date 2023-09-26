<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DetailPembelian;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailPembelianResource;
use App\Http\Resources\DetailPembelianCollection;
use App\Http\Requests\DetailPembelianStoreRequest;
use App\Http\Requests\DetailPembelianUpdateRequest;

class DetailPembelianController extends Controller
{
    public function index(Request $request): DetailPembelianCollection
    {
        $this->authorize('view-any', DetailPembelian::class);

        $search = $request->get('search', '');

        $detailPembelians = DetailPembelian::search($search)
            ->latest()
            ->paginate();

        return new DetailPembelianCollection($detailPembelians);
    }

    public function store(
        DetailPembelianStoreRequest $request
    ): DetailPembelianResource {
        $this->authorize('create', DetailPembelian::class);

        $validated = $request->validated();

        $detailPembelian = DetailPembelian::create($validated);

        return new DetailPembelianResource($detailPembelian);
    }

    public function show(
        Request $request,
        DetailPembelian $detailPembelian
    ): DetailPembelianResource {
        $this->authorize('view', $detailPembelian);

        return new DetailPembelianResource($detailPembelian);
    }

    public function update(
        DetailPembelianUpdateRequest $request,
        DetailPembelian $detailPembelian
    ): DetailPembelianResource {
        $this->authorize('update', $detailPembelian);

        $validated = $request->validated();

        $detailPembelian->update($validated);

        return new DetailPembelianResource($detailPembelian);
    }

    public function destroy(
        Request $request,
        DetailPembelian $detailPembelian
    ): Response {
        $this->authorize('delete', $detailPembelian);

        $detailPembelian->delete();

        return response()->noContent();
    }
}
