@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('tampung-bayars.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.tampung_bayar.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.tampung_bayar.inputs.penjualan_id')</h5>
                    <span
                        >{{ optional($tampungBayar->penjualan)->no_faktur ?? '-'
                        }}</span
                    >
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.tampung_bayar.inputs.total')</h5>
                    <span>{{ $tampungBayar->total ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.tampung_bayar.inputs.terima')</h5>
                    <span>{{ $tampungBayar->terima ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.tampung_bayar.inputs.kembali')</h5>
                    <span>{{ $tampungBayar->kembali ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a
                    href="{{ route('tampung-bayars.index') }}"
                    class="btn btn-light"
                >
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\TampungBayar::class)
                <a
                    href="{{ route('tampung-bayars.create') }}"
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
