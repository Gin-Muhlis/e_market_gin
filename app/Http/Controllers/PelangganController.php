<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PelangganStoreRequest;
use App\Http\Requests\PelangganUpdateRequest;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Pelanggan::class);

        $search = $request->get('search', '');

        $pelanggans = Pelanggan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.pelanggans.index', compact('pelanggans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Pelanggan::class);

        return view('app.pelanggans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PelangganStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Pelanggan::class);

        $validated = $request->validated();

        $pelanggan = Pelanggan::create($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pelanggan $pelanggan): View
    {
        $this->authorize('view', $pelanggan);

        return view('app.pelanggans.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Pelanggan $pelanggan): View
    {
        $this->authorize('update', $pelanggan);

        return view('app.pelanggans.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PelangganUpdateRequest $request,
        Pelanggan $pelanggan
    ): RedirectResponse {
        $this->authorize('update', $pelanggan);

        $validated = $request->validated();

        $pelanggan->update($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Pelanggan $pelanggan
    ): RedirectResponse {
        $this->authorize('delete', $pelanggan);

        $pelanggan->delete();

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.removed'));
    }
}
