<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\View\View;
use App\Models\Pembelian;
use Illuminate\Http\Request;
use App\Models\DetailPembelian;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DetailPembelianStoreRequest;
use App\Http\Requests\DetailPembelianUpdateRequest;

class DetailPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DetailPembelian::class);

        $search = $request->get('search', '');

        $detailPembelians = DetailPembelian::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.detail_pembelians.index',
            compact('detailPembelians', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DetailPembelian::class);

        $pembelians = Pembelian::pluck('kode_masuk', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view(
            'app.detail_pembelians.create',
            compact('pembelians', 'barangs')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        DetailPembelianStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', DetailPembelian::class);

        $validated = $request->validated();

        $detailPembelian = DetailPembelian::create($validated);

        return redirect()
            ->route('detail-pembelians.edit', $detailPembelian)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        DetailPembelian $detailPembelian
    ): View {
        $this->authorize('view', $detailPembelian);

        return view('app.detail_pembelians.show', compact('detailPembelian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        DetailPembelian $detailPembelian
    ): View {
        $this->authorize('update', $detailPembelian);

        $pembelians = Pembelian::pluck('kode_masuk', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view(
            'app.detail_pembelians.edit',
            compact('detailPembelian', 'pembelians', 'barangs')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DetailPembelianUpdateRequest $request,
        DetailPembelian $detailPembelian
    ): RedirectResponse {
        $this->authorize('update', $detailPembelian);

        $validated = $request->validated();

        $detailPembelian->update($validated);

        return redirect()
            ->route('detail-pembelians.edit', $detailPembelian)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DetailPembelian $detailPembelian
    ): RedirectResponse {
        $this->authorize('delete', $detailPembelian);

        $detailPembelian->delete();

        return redirect()
            ->route('detail-pembelians.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
