<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\DetailTransaksi;
use App\Http\Controllers\Controller;
use App\Http\Resources\DetailTransaksiResource;
use App\Http\Resources\DetailTransaksiCollection;
use App\Http\Requests\DetailTransaksiStoreRequest;
use App\Http\Requests\DetailTransaksiUpdateRequest;

class DetailTransaksiController extends Controller
{
    public function index(Request $request): DetailTransaksiCollection
    {
        $this->authorize('view-any', DetailTransaksi::class);

        $search = $request->get('search', '');

        $detailTransaksis = DetailTransaksi::search($search)
            ->latest()
            ->paginate();

        return new DetailTransaksiCollection($detailTransaksis);
    }

    public function store(
        DetailTransaksiStoreRequest $request
    ): DetailTransaksiResource {
        $this->authorize('create', DetailTransaksi::class);

        $validated = $request->validated();

        $detailTransaksi = DetailTransaksi::create($validated);

        return new DetailTransaksiResource($detailTransaksi);
    }

    public function show(
        Request $request,
        DetailTransaksi $detailTransaksi
    ): DetailTransaksiResource {
        $this->authorize('view', $detailTransaksi);

        return new DetailTransaksiResource($detailTransaksi);
    }

    public function update(
        DetailTransaksiUpdateRequest $request,
        DetailTransaksi $detailTransaksi
    ): DetailTransaksiResource {
        $this->authorize('update', $detailTransaksi);

        $validated = $request->validated();

        $detailTransaksi->update($validated);

        return new DetailTransaksiResource($detailTransaksi);
    }

    public function destroy(
        Request $request,
        DetailTransaksi $detailTransaksi
    ): Response {
        $this->authorize('delete', $detailTransaksi);

        $detailTransaksi->delete();

        return response()->noContent();
    }
}
