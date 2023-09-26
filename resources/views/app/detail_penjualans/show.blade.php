@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('detail-penjualans.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.detail_penjualan.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.detail_penjualan.inputs.harga_jual')</h5>
                    <span>{{ $detailPenjualan->harga_jual ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_penjualan.inputs.jumlah')</h5>
                    <span>{{ $detailPenjualan->jumlah ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_penjualan.inputs.sub_total')</h5>
                    <span>{{ $detailPenjualan->sub_total ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_penjualan.inputs.penjualan_id')</h5>
                    <span
                        >{{ optional($detailPenjualan->penjualan)->no_faktur ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_penjualan.inputs.barang_id')</h5>
                    <span
                        >{{ optional($detailPenjualan->barang)->kode_barang ??
                        '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('detail-penjualans.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\DetailPenjualan::class)
                <a
                    href="{{ route('detail-penjualans.create') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
