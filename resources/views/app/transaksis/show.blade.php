@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('transaksis.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.transaksi.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.transaksi.inputs.kode_transaksi')</h5>
                    <span>{{ $transaksi->kode_transaksi ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transaksi.inputs.tgl_bayar')</h5>
                    <span>{{ $transaksi->tgl_bayar ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transaksi.inputs.user_input')</h5>
                    <span>{{ $transaksi->user_input ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.transaksi.inputs.rombel_id')</h5>
                    <span
                        >{{ optional($transaksi->rombel)->rombel ?? '-' }}</span
                    >
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('transaksis.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Transaksi::class)
                <a
                    href="{{ route('transaksis.create') }}"
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
