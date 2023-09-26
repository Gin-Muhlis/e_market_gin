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
                @can('create', App\Models\DetailPembelian::class)
                <a
                    href="{{ route('detail-pembelians.create') }}"
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
                    @lang('crud.detail_pembelian.index_title')
                </h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-right">
                                @lang('crud.detail_pembelian.inputs.harga_beli')
                            </th>
                            <th class="text-right">
                                @lang('crud.detail_pembelian.inputs.jumlah')
                            </th>
                            <th class="text-right">
                                @lang('crud.detail_pembelian.inputs.sub_total')
                            </th>
                            <th class="text-left">
                                @lang('crud.detail_pembelian.inputs.pembelian_id')
                            </th>
                            <th class="text-left">
                                @lang('crud.detail_pembelian.inputs.barang_id')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detailPembelians as $detailPembelian)
                        <tr>
                            <td>{{ $detailPembelian->harga_beli ?? '-' }}</td>
                            <td>{{ $detailPembelian->jumlah ?? '-' }}</td>
                            <td>{{ $detailPembelian->sub_total ?? '-' }}</td>
                            <td>
                                {{
                                optional($detailPembelian->pembelian)->kode_masuk
                                ?? '-' }}
                            </td>
                            <td>
                                {{
                                optional($detailPembelian->barang)->kode_barang
                                ?? '-' }}
                            </td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $detailPembelian)
                                    <a
                                        href="{{ route('detail-pembelians.edit', $detailPembelian) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $detailPembelian)
                                    <a
                                        href="{{ route('detail-pembelians.show', $detailPembelian) }}"
                                    >
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $detailPembelian)
                                    <form
                                        action="{{ route('detail-pembelians.destroy', $detailPembelian) }}"
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
                                {!! $detailPembelians->render() !!}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
