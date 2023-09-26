@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('detail-pembelians.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.detail_pembelian.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.detail_pembelian.inputs.harga_beli')</h5>
                    <span>{{ $detailPembelian->harga_beli ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_pembelian.inputs.jumlah')</h5>
                    <span>{{ $detailPembelian->jumlah ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_pembelian.inputs.sub_total')</h5>
                    <span>{{ $detailPembelian->sub_total ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_pembelian.inputs.pembelian_id')</h5>
                    <span
                        >{{ optional($detailPembelian->pembelian)->kode_masuk ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_pembelian.inputs.barang_id')</h5>
                    <span
                        >{{ optional($detailPembelian->barang)->kode_barang ??
                        '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('detail-pembelians.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\DetailPembelian::class)
                <a
                    href="{{ route('detail-pembelians.create') }}"
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
