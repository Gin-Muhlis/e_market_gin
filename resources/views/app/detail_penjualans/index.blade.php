@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\DetailPenjualan::class)
                <a
                    href="{{ route('detail-penjualans.create') }}"
                    class="btn btn-primary"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">
                    @lang('crud.detail_penjualan.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.detail_penjualan.inputs.harga_jual')
                            </th>
                            <th class="text-right">
                                @lang('crud.detail_penjualan.inputs.jumlah')
                            </th>
                            <th class="text-right">
                                @lang('crud.detail_penjualan.inputs.sub_total')
                            </th>
                            <th class="text-left">
                                @lang('crud.detail_penjualan.inputs.penjualan_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.detail_penjualan.inputs.barang_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailPenjualans as $detailPenjualan)
                        <tr>
                            <td>{{ $detailPenjualan->harga_jual ?? '-' }}</td>
                            <td>{{ $detailPenjualan->jumlah ?? '-' }}</td>
                            <td>{{ $detailPenjualan->sub_total ?? '-' }}</td>
                            <td>
                                {{
                                optional($detailPenjualan->penjualan)->no_faktur
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($detailPenjualan->barang)->kode_barang
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $detailPenjualan)
                                    <a
                                        href="{{ route('detail-penjualans.edit', $detailPenjualan) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $detailPenjualan)
                                    <a
                                        href="{{ route('detail-penjualans.show', $detailPenjualan) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $detailPenjualan)
                                    <form
                                        action="{{ route('detail-penjualans.destroy', $detailPenjualan) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                {!! $detailPenjualans->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
