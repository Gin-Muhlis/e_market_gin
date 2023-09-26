@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('detail-transaksis.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.detail_transaksi.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.detail_transaksi.inputs.jumlah_bayar')</h5>
                    <span>{{ $detailTransaksi->jumlah_bayar ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.detail_transaksi.inputs.transaksi_id')</h5>
                    <span
                        >{{
                        optional($detailTransaksi->transaksi)->kode_transaksi ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>
                        @lang('crud.detail_transaksi.inputs.jenis_pembayaran_id')
                    </h5>
                    <span
                        >{{ optional($detailTransaksi->jenisPembayaran)->nama ??
                        '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('detail-transaksis.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\DetailTransaksi::class)
                <a
                    href="{{ route('detail-transaksis.create') }}"
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
