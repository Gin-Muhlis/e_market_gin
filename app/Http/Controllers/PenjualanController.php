<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penjualan;
use Illuminate\View\View;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PenjualanStoreRequest;
use App\Http\Requests\PenjualanUpdateRequest;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Penjualan::class);

        $search = $request->get('search', '');

        $penjualans = Penjualan::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.penjualans.index', compact('penjualans', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Penjualan::class);

        $pelanggans = Pelanggan::pluck('kode_pelanggan', 'id');
        $users = User::pluck('name', 'id');

        return view('app.penjualans.create', compact('pelanggans', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PenjualanStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Penjualan::class);

        $validated = $request->validated();

        $penjualan = Penjualan::create($validated);

        return redirect()
            ->route('penjualans.edit', $penjualan)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Penjualan $penjualan): View
    {
        $this->authorize('view', $penjualan);

        return view('app.penjualans.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Penjualan $penjualan): View
    {
        $this->authorize('update', $penjualan);

        $pelanggans = Pelanggan::pluck('kode_pelanggan', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.penjualans.edit',
            compact('penjualan', 'pelanggans', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PenjualanUpdateRequest $request,
        Penjualan $penjualan
    ): RedirectResponse {
        $this->authorize('update', $penjualan);

        $validated = $request->validated();

        $penjualan->update($validated);

        return redirect()
            ->route('penjualans.edit', $penjualan)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Penjualan $penjualan
    ): RedirectResponse {
        $this->authorize('delete', $penjualan);

        $penjualan->delete();

        return redirect()
            ->route('penjualans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
