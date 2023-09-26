<?php

namespace App\Http\Controllers;

use App\Models\Rombel;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RombelStoreRequest;
use App\Http\Requests\RombelUpdateRequest;

class RombelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Rombel::class);

        $search = $request->get('search', '');

        $rombels = Rombel::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.rombels.index', compact('rombels', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Rombel::class);

        return view('app.rombels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RombelStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Rombel::class);

        $validated = $request->validated();

        $rombel = Rombel::create($validated);

        return redirect()
            ->route('rombels.edit', $rombel)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Rombel $rombel): View
    {
        $this->authorize('view', $rombel);

        return view('app.rombels.show', compact('rombel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Rombel $rombel): View
    {
        $this->authorize('update', $rombel);

        return view('app.rombels.edit', compact('rombel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RombelUpdateRequest $request,
        Rombel $rombel
    ): RedirectResponse {
        $this->authorize('update', $rombel);

        $validated = $request->validated();

        $rombel->update($validated);

        return redirect()
            ->route('rombels.edit', $rombel)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Rombel $rombel): RedirectResponse
    {
        $this->authorize('delete', $rombel);

        $rombel->delete();

        return redirect()
            ->route('rombels.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
