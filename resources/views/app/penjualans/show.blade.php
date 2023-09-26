@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('penjualans.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.penjualan.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.penjualan.inputs.no_faktur')</h5>
                    <span>{{ $penjualan->no_faktur ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.penjualan.inputs.tgl_faktur')</h5>
                    <span>{{ $penjualan->tgl_faktur ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.penjualan.inputs.total_bayar')</h5>
                    <span>{{ $penjualan->total_bayar ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.penjualan.inputs.pelanggan_id')</h5>
                    <span
                        >{{ optional($penjualan->pelanggan)->kode_pelanggan ??
                        '-' }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.penjualan.inputs.user_id')</h5>
                    <span>{{ optional($penjualan->user)->name ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('penjualans.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Penjualan::class)
                <a
                    href="{{ route('penjualans.create') }}"
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
