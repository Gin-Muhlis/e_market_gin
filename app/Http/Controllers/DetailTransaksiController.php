<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use App\Models\JenisPembayaran;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DetailTransaksiStoreRequest;
use App\Http\Requests\DetailTransaksiUpdateRequest;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', DetailTransaksi::class);

        $search = $request->get('search', '');

        $detailTransaksis = DetailTransaksi::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.detail_transaksis.index',
            compact('detailTransaksis', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', DetailTransaksi::class);

        $transaksis = Transaksi::pluck('kode_transaksi', 'id');
        $jenisPembayarans = JenisPembayaran::pluck('nama', 'id');

        return view(
            'app.detail_transaksis.create',
            compact('transaksis', 'jenisPembayarans')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        DetailTransaksiStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', DetailTransaksi::class);

        $validated = $request->validated();

        $detailTransaksi = DetailTransaksi::create($validated);

        return redirect()
            ->route('detail-transaksis.edit', $detailTransaksi)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        DetailTransaksi $detailTransaksi
    ): View {
        $this->authorize('view', $detailTransaksi);

        return view('app.detail_transaksis.show', compact('detailTransaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        DetailTransaksi $detailTransaksi
    ): View {
        $this->authorize('update', $detailTransaksi);

        $transaksis = Transaksi::pluck('kode_transaksi', 'id');
        $jenisPembayarans = JenisPembayaran::pluck('nama', 'id');

        return view(
            'app.detail_transaksis.edit',
            compact('detailTransaksi', 'transaksis', 'jenisPembayarans')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DetailTransaksiUpdateRequest $request,
        DetailTransaksi $detailTransaksi
    ): RedirectResponse {
        $this->authorize('update', $detailTransaksi);

        $validated = $request->validated();

        $detailTransaksi->update($validated);

        return redirect()
            ->route('detail-transaksis.edit', $detailTransaksi)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        DetailTransaksi $detailTransaksi
    ): RedirectResponse {
        $this->authorize('delete', $detailTransaksi);

        $detailTransaksi->delete();

        return redirect()
            ->route('detail-transaksis.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
