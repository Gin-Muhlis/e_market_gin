@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-12 text-left">
                    @can('create', App\Models\Produk::class)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-modal"
                            data-mode="add">
                            <i class="icon ion-md-add"></i> Tambah
                        </button>
                    @endcan
                    <a href="{{ route('produks.export') }}" class="btn btn-success">Download Excel</a>
                    <button class="btn-import btn btn-primary">Import Excel</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.produk.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.produk.inputs.nama_produk')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produks as $produk)
                                <tr>
                                    <td>{{ $produk->nama_produk ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $produk)
                                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                    data-bs-target="#form-modal" data-mode="edit" data-id="{{ $produk->id }}"
                                                    data-nama="{{ $produk->nama_produk }}" >
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            @endcan
                                            @can('delete', $produk)
                                                <form action="{{ route('produks.destroy', $produk) }}" method="POST"
                                                   >
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-light text-danger delete-btn" data-nama="{{ $produk->nama_produk }}">
                                                        <i class="icon ion-md-trash"></i>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">
                                        @lang('crud.common.no_items_found')
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                       y7[]
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('app.produks.form-inputs')
    <form action="{{ route('pembelian.import') }}" method="post">
        @csrf
        <input type='file' name='file' id="file">
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#form-modal").on("show.bs.modal", event => {
                const btn = $(event.relatedTarget)
                const modal = $(this)
                let mode = $(btn).data("mode")
                switch (mode) {
                    case "add":
                        modal.find(".modal-title").text("Tambah Data Produk")
                        modal.find("#method").html("")
                        modal.find("#nama_produk").val("")
                        modal.find(".modal-body form").attr("action", "/produks")
                        break;
                    case "edit":
                        let nama = $(btn).data("nama")
                        let id = $(btn).data("id")
                        modal.find(".modal-title").text("Edit Data Produk")
                        modal.find("#method").html(`@method("PUT")`)
                        modal.find("#nama_produk").val(nama)
                        modal.find(".modal-body form").attr("action", `/produks/${id}`)
                    default:
                        break;
                }
            })

            $(".delete-btn").on("click", event => {
                event.preventDefault()
                const nama = $(this).data("nama")
                Swal.fire({
                    title: `Apakah data <span style="color: red;"></span> akan dihapus?`,
                    text: "Data tidak bisa dikembalikan!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#dd3333",
                    confirmButtonText: "Ya, hapus data ini"
                }).then(result => {
                    if (result.isConfirmed) 
                        $(event.target).closest("form").submit()
                    else Swal.close()
                })
            })
        })
    </script>
@endpush
