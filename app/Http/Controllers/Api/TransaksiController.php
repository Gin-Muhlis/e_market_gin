<?php

namespace App\Http\Controllers\Api;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransaksiResource;
use App\Http\Resources\TransaksiCollection;
use App\Http\Requests\TransaksiStoreRequest;
use App\Http\Requests\TransaksiUpdateRequest;

class TransaksiController extends Controller
{
    public function index(Request $request): TransaksiCollection
    {
        $this->authorize('view-any', Transaksi::class);

        $search = $request->get('search', '');

        $transaksis = Transaksi::search($search)
            ->latest()
            ->paginate();

        return new TransaksiCollection($transaksis);
    }

    public function store(TransaksiStoreRequest $request): TransaksiResource
    {
        $this->authorize('create', Transaksi::class);

        $validated = $request->validated();

        $transaksi = Transaksi::create($validated);

        return new TransaksiResource($transaksi);
    }

    public function show(
        Request $request,
        Transaksi $transaksi
    ): TransaksiResource {
        $this->authorize('view', $transaksi);

        return new TransaksiResource($transaksi);
    }

    public function update(
        TransaksiUpdateRequest $request,
        Transaksi $transaksi
    ): TransaksiResource {
        $this->authorize('update', $transaksi);

        $validated = $request->validated();

        $transaksi->update($validated);

        return new TransaksiResource($transaksi);
    }

    public function destroy(Request $request, Transaksi $transaksi): Response
    {
        $this->authorize('delete', $transaksi);

        $transaksi->delete();

        return response()->noContent();
    }
}
