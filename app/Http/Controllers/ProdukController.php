<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Produk;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use App\Imports\ProdukImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProdukStoreRequest;
use App\Http\Requests\ProdukUpdateRequest;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Produk::class);


        $produks = Produk::latest()->get();

        return view('app.produks.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Produk::class);

        return view('app.produks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProdukStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Produk::class);

        $validated = $request->validated();

        $produk = Produk::create($validated);

        return redirect()
        ->back()
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Produk $produk): View
    {
        $this->authorize('view', $produk);

        return view('app.produks.show', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Produk $produk): View
    {
        $this->authorize('update', $produk);

        return view('app.produks.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProdukUpdateRequest $request,
        Produk $produk
    ): RedirectResponse {
        try {
            $this->authorize('update', $produk);

            $validated = $request->validated();
    
            $produk->update($validated);
    
            return redirect()
                ->back()
                ->withSuccess(__('crud.common.saved'));
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withErrors('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Produk $produk): RedirectResponse
    {
        $this->authorize('delete', $produk);

        $produk->delete();

        return redirect()
            ->route('produks.index')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export() {
        $tanggal = Carbon::now()->format('Y-m-d');
        return Excel::download(new ProdukExport, "produk_$tanggal.xlsx");
    }

    public function import(Request $request) {
        $file = $request->file;
        Excel::import(new ProdukImport, $file);
        return redirect()->back()->with('success', 'Import data berhasil');
    }
}
