<?php

namespace App\Http\Controllers\Api;

use App\Models\TampungBayar;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\TampungBayarResource;
use App\Http\Resources\TampungBayarCollection;
use App\Http\Requests\TampungBayarStoreRequest;
use App\Http\Requests\TampungBayarUpdateRequest;

class TampungBayarController extends Controller
{
    public function index(Request $request): TampungBayarCollection
    {
        $this->authorize('view-any', TampungBayar::class);

        $search = $request->get('search', '');

        $tampungBayars = TampungBayar::search($search)
            ->latest()
            ->paginate();

        return new TampungBayarCollection($tampungBayars);
    }

    public function store(
        TampungBayarStoreRequest $request
    ): TampungBayarResource {
        $this->authorize('create', TampungBayar::class);

        $validated = $request->validated();

        $tampungBayar = TampungBayar::create($validated);

        return new TampungBayarResource($tampungBayar);
    }

    public function show(
        Request $request,
        TampungBayar $tampungBayar
    ): TampungBayarResource {
        $this->authorize('view', $tampungBayar);

        return new TampungBayarResource($tampungBayar);
    }

    public function update(
        TampungBayarUpdateRequest $request,
        TampungBayar $tampungBayar
    ): TampungBayarResource {
        $this->authorize('update', $tampungBayar);

        $validated = $request->validated();

        $tampungBayar->update($validated);

        return new TampungBayarResource($tampungBayar);
    }

    public function destroy(
        Request $request,
        TampungBayar $tampungBayar
    ): Response {
        $this->authorize('delete', $tampungBayar);

        $tampungBayar->delete();

        return response()->noContent();
    }
}
