<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\JenisPembayaran;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\JenisPembayaranStoreRequest;
use App\Http\Requests\JenisPembayaranUpdateRequest;

class JenisPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', JenisPembayaran::class);

        $search = $request->get('search', '');

        $jenisPembayarans = JenisPembayaran::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view(
            'app.jenis_pembayarans.index',
            compact('jenisPembayarans', 'search')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', JenisPembayaran::class);

        return view('app.jenis_pembayarans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        JenisPembayaranStoreRequest $request
    ): RedirectResponse {
        $this->authorize('create', JenisPembayaran::class);

        $validated = $request->validated();

        $jenisPembayaran = JenisPembayaran::create($validated);

        return redirect()
            ->route('jenis-pembayarans.edit', $jenisPembayaran)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(
        Request $request,
        JenisPembayaran $jenisPembayaran
    ): View {
        $this->authorize('view', $jenisPembayaran);

        return view('app.jenis_pembayarans.show', compact('jenisPembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(
        Request $request,
        JenisPembayaran $jenisPembayaran
    ): View {
        $this->authorize('update', $jenisPembayaran);

        return view('app.jenis_pembayarans.edit', compact('jenisPembayaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        JenisPembayaranUpdateRequest $request,
        JenisPembayaran $jenisPembayaran
    ): RedirectResponse {
        $this->authorize('update', $jenisPembayaran);

        $validated = $request->validated();

        $jenisPembayaran->update($validated);

        return redirect()
            ->route('jenis-pembayarans.edit', $jenisPembayaran)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        JenisPembayaran $jenisPembayaran
    ): RedirectResponse {
        $this->authorize('delete', $jenisPembayaran);

        $jenisPembayaran->delete();

        return redirect()
            ->route('jenis-pembayarans.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
