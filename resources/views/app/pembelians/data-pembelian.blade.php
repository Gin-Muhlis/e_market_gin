@php
    require_once app_path() . '/Helpers/helper.php';
@endphp

@extends('layouts.app')

@section('content')
    <div class="container">

        <h3 class="mb-3">Data Penjualan</h3>
        <div class="card">
            <div class="card-body">
                <form action="">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <label for="tanggalAwal">Tanggal Awal</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="tanggalAwal" name="tanggal_awal" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1 text-center">
                            <span class="fw-bold fs-6">s/d</span>
                        </div>
                        <div class="col-md-5">
                            <div class="row align-items-center">
                                <div class="col-md-3">
                                    <label for="tanggalAkhir">Tanggal Akhir</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="date" class="form-control" id="tanggalAkhir" name="tanggal_akhir" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-primary">Cari</button>
                        </div>
                    </div>
                </form>
                <div class="w-100 text-center p-4 mt-4 mb-2">
                    <h3>Data Penjualan</h3>
                    <span class="fs-5">{{ !is_null($tanggal_awal) ? generateDate($tanggal_awal) : generateDate($sekarang) }} s/d {{ !is_null($tanggal_akhir) ? generateDate($tanggal_akhir) : generateDate($sekarang) }}</>
                </div>
               <div class="mb-4">
                <a href="{{route('pembelians.index')}}" class="btn btn-primary">Tambah Pembelian</a>
                <button id="btn-export-excel" class="btn btn-success">Download Excel</bu>
               </div>
               <table class="table table-borderless table-hover" id="myTable">
                <thead>
                    <tr class="bg-primary text-white">
                        <th>No</th>
                        <th>Kode</th>
                        <th>Supplier</th>
                        <th class="text-center">Total Pembelian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_pembelian as $item)
                       <tr>
                        <td class="text-center">{{ $loop->index + 1}}</td>
                        <td class="text-center">{{ $item->kode_masuk }}</td>
                        <td class="text-center">{{ $item->pemasok->nama_pemasok }}</td>
                        <td class="text-center">{{ $item->total }}</td>
                       </tr>
                    @endforeach
                </tbody>
               </table>
            </div>
        </div>
    </div>
    <form action="{{ route('pembelians.export') }}" method="get" id="form-export-excel">
        <input type="hidden" name="tanggal_awal_export" id="tanggalAwalExport" value="{{ $tanggal_awal ?? $sekarang }}">
        <input type="hidden" name="tanggal_akhir_export" id="tanggalAkhirExport" value="{{ $tanggal_akhir ?? $sekarang }}">
    </form>
@endsection

@push('scripts')
    <script>
        $("#tanggalAwal").on("input", (event) => {
            $("#tanggalAwalExport").val($(this).val());
        })

        $("#tanggalAkhir").on("input", (event) => {
            $("#tanggalAkhirExport").val($(this).val());
        })

        $("#btn-export-excel").on("click", () => {
            $("#form-export-excel").submit();
        })
    </script>
@endpush