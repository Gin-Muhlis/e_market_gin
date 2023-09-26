<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\PemasokStoreRequest;
use App\Http\Requests\PemasokUpdateRequest;

class PemasokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Pemasok::class);

        $search = $request->get('search', '');

        $pemasoks = Pemasok::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.pemasoks.index', compact('pemasoks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Pemasok::class);

        return view('app.pemasoks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PemasokStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Pemasok::class);

        $validated = $request->validated();

        $pemasok = Pemasok::create($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Pemasok $pemasok): View
    {
        $this->authorize('view', $pemasok);

        return view('app.pemasoks.show', compact('pemasok'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Pemasok $pemasok): View
    {
        $this->authorize('update', $pemasok);

        return view('app.pemasoks.edit', compact('pemasok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        PemasokUpdateRequest $request,
        Pemasok $pemasok
    ): RedirectResponse {
        $this->authorize('update', $pemasok);

        $validated = $request->validated();

        $pemasok->update($validated);

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Pemasok $pemasok
    ): RedirectResponse {
        $this->authorize('delete', $pemasok);

        $pemasok->delete();

        return redirect()
            ->back()
            ->withSuccess(__('crud.common.removed'));
    }
}
