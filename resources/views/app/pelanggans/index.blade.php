@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-12 text-left">
                    @can('create', App\Models\Pelanggan::class)
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#form-modal"
                            data-mode="add">
                            <i class="icon ion-md-add"></i> Tambah
                        </button>
                    @endcan
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div style="display: flex; justify-content: space-between;">
                    <h4 class="card-title">@lang('crud.pelanggan.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.kode_pelanggan')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.nama')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.alamat')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.no_telp')
                                </th>
                                <th class="text-left">
                                    @lang('crud.pelanggan.inputs.email')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pelanggans as $pelanggan)
                                <tr>
                                    <td>{{ $pelanggan->kode_pelanggan ?? '-' }}</td>
                                    <td>{{ $pelanggan->nama ?? '-' }}</td>
                                    <td>{{ $pelanggan->alamat ?? '-' }}</td>
                                    <td>{{ $pelanggan->no_telp ?? '-' }}</td>
                                    <td>{{ $pelanggan->email ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $pelanggan)
                                            <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                            data-bs-target="#form-modal" data-mode="edit"
                                            data-id="{{ $pelanggan->id }}">
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                                @endcan
                                                @can('delete', $pelanggan)
                                                <form action="{{ route('pelanggans.destroy', $pelanggan) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button <button type="submit" class="btn btn-light text-danger delete-btn">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('app.pelanggans.form-inputs')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const object = JSON.stringify(@json($pelanggans))
            const data = JSON.parse(object).data

            $("#form-modal").on("show.bs.modal", event => {
                const btn = $(event.relatedTarget)
                const modal = $(this)
                let mode = $(btn).data("mode")
                switch (mode) {
                    case "add":
                        console.log("add")
                        modal.find(".modal-title").text("Tambah Data Pelanggan")
                        modal.find("#method").html("")
                        setValue()
                        modal.find(".modal-body form").attr("action", `{{ url('pelanggans') }}`)
                        break;
                    case "edit":
                        const idPelanggan = btn.data("id")
                        const pelanggan = data.find(item => item.id == idPelanggan)
                        modal.find(".modal-title").text("Edit Data Pelanggan")
                        modal.find("#method").html(`@method('PUT')`)
                        setValue(pelanggan.kode_pelanggan, pelanggan.nama, pelanggan.alamat, pelanggan.no_telp, pelanggan.email)
                        modal.find(".modal-body form").attr("action", `{{ url('pelanggans') }}/${idPelanggan}`)
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

            function setValue(kodePelanggan = "", nama = "", alamat = "", noTelp = "", email ="") {
                const modalForm = $("#form-modal")

                modalForm.find("#kode_pelanggan").val(kodePelanggan)
                modalForm.find("#nama").val(nama)
                modalForm.find("#alamat").val(alamat)
                modalForm.find("#no_telp").val(noTelp)
                modalForm.find("#email").val(email)

                return true
            }
        })
    </script>
@endpush
