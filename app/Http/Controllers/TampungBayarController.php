<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Penjualan;
use App\Models\TampungBayar;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\TampungBayarStoreRequest;
use App\Http\Requests\TampungBayarUpdateRequest;

class TampungBayarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', TampungBayar::class);

        $search = $request->get('search', '');

        $tampungBayars = TampungBayar::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.tampung_bayars.index',
            compact('tampungBayars', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', TampungBayar::class);

        $penjualans = Penjualan::pluck('no_faktur', 'id');

        return view('app.tampung_bayars.create', compact('penjualans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TampungBayarStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', TampungBayar::class);

        $validated = $request->validated();

        $tampungBayar = TampungBayar::create($validated);

        return redirect()
            ->route('tampung-bayars.edit', $tampungBayar)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, TampungBayar $tampungBayar): View
    {
        $this->authorize('view', $tampungBayar);

        return view('app.tampung_bayars.show', compact('tampungBayar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, TampungBayar $tampungBayar): View
    {
        $this->authorize('update', $tampungBayar);

        $penjualans = Penjualan::pluck('no_faktur', 'id');

        return view(
            'app.tampung_bayars.edit',
            compact('tampungBayar', 'penjualans')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        TampungBayarUpdateRequest $request,
        TampungBayar $tampungBayar
    ): RedirectResponse {
        $this->authorize('update', $tampungBayar);

        $validated = $request->validated();

        $tampungBayar->update($validated);

        return redirect()
            ->route('tampung-bayars.edit', $tampungBayar)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        TampungBayar $tampungBayar
    ): RedirectResponse {
        $this->authorize('delete', $tampungBayar);

        $tampungBayar->delete();

        return redirect()
            ->route('tampung-bayars.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
