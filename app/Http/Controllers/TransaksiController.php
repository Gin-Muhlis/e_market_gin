<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use App\Models\Transaksi;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TransaksiStoreRequest;
use App\Http\Requests\TransaksiUpdateRequest;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Transaksi::class);

        $search = $request->get('search', '');

        $transaksis = Transaksi::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.transaksis.index', compact('transaksis', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Transaksi::class);

        $rombels = Rombel::pluck('rombel', 'id');

        return view('app.transaksis.create', compact('rombels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransaksiStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Transaksi::class);

        $validated = $request->validated();

        $transaksi = Transaksi::create($validated);

        return redirect()
            ->route('transaksis.edit', $transaksi)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Transaksi $transaksi): View
    {
        $this->authorize('view', $transaksi);

        return view('app.transaksis.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Transaksi $transaksi): View
    {
        $this->authorize('update', $transaksi);

        $rombels = Rombel::pluck('rombel', 'id');

        return view('app.transaksis.edit', compact('transaksi', 'rombels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TransaksiUpdateRequest $request,
        Transaksi $transaksi
    ): RedirectResponse {
        $this->authorize('update', $transaksi);

        $validated = $request->validated();

        $transaksi->update($validated);

        return redirect()
            ->route('transaksis.edit', $transaksi)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Transaksi $transaksi
    ): RedirectResponse {
        $this->authorize('delete', $transaksi);

        $transaksi->delete();

        return redirect()
            ->route('transaksis.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
