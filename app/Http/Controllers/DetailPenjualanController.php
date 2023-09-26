<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\View\View;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\DetailPenjualan;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DetailPenjualanStoreRequest;
use App\Http\Requests\DetailPenjualanUpdateRequest;

class DetailPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DetailPenjualan::class);

        $search = $request->get('search', '');

        $detailPenjualans = DetailPenjualan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.detail_penjualans.index',
            compact('detailPenjualans', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DetailPenjualan::class);

        $penjualans = Penjualan::pluck('no_faktur', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view(
            'app.detail_penjualans.create',
            compact('penjualans', 'barangs')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        DetailPenjualanStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', DetailPenjualan::class);

        $validated = $request->validated();

        $detailPenjualan = DetailPenjualan::create($validated);

        return redirect()
            ->route('detail-penjualans.edit', $detailPenjualan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        DetailPenjualan $detailPenjualan
    ): View {
        $this->authorize('view', $detailPenjualan);

        return view('app.detail_penjualans.show', compact('detailPenjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        DetailPenjualan $detailPenjualan
    ): View {
        $this->authorize('update', $detailPenjualan);

        $penjualans = Penjualan::pluck('no_faktur', 'id');
        $barangs = Barang::pluck('kode_barang', 'id');

        return view(
            'app.detail_penjualans.edit',
            compact('detailPenjualan', 'penjualans', 'barangs')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DetailPenjualanUpdateRequest $request,
        DetailPenjualan $detailPenjualan
    ): RedirectResponse {
        $this->authorize('update', $detailPenjualan);

        $validated = $request->validated();

        $detailPenjualan->update($validated);

        return redirect()
            ->route('detail-penjualans.edit', $detailPenjualan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DetailPenjualan $detailPenjualan
    ): RedirectResponse {
        $this->authorize('delete', $detailPenjualan);

        $detailPenjualan->delete();

        return redirect()
            ->route('detail-penjualans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
