<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Produk;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BarangStoreRequest;
use App\Http\Requests\BarangUpdateRequest;
use Illuminate\Support\Facades\Auth;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Barang::class);

        $barangs = Barang::get();

        $users = User::pluck('name', 'id');
        $produks = Produk::pluck('nama_produk', 'id');

        return view('app.barangs.index', compact('barangs', 'users', 'produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Barang::class);

        $users = User::pluck('name', 'id');
        $produks = Produk::pluck('nama_produk', 'id');

        return view('app.barangs.create', compact('users', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BarangStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Barang::class);

        $user = Auth::user();

        $validated = $request->validated();
        $validated['ditarik'] = 0;
        $validated['user_id'] = $user->id;

        $barang = Barang::create($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Barang $barang): View
    {
        $this->authorize('view', $barang);

        return view('app.barangs.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Barang $barang): View
    {
        $this->authorize('update', $barang);

        $users = User::pluck('name', 'id');
        $produks = Produk::pluck('nama_produk', 'id');

        return view('app.barangs.edit', compact('barang', 'users', 'produks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BarangUpdateRequest $request,
        Barang $barang
    ): RedirectResponse {
        $this->authorize('update', $barang);

        $user = Auth::user();

        $validated = $request->validated();
        $validated['user_id'] = $user->id;
        $barang->update($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Barang $barang): RedirectResponse
    {
        $this->authorize('delete', $barang);

        $barang->delete();

        return redirect()
            ->route('barangs.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
