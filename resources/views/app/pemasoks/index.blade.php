@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="searchbar mt-0 mb-4">
            <div class="row">
                <div class="col-md-12 text-left">
                    @can('create', App\Models\Pemasok::class)
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
                    <h4 class="card-title">@lang('crud.pemasok.index_title')</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-borderless table-hover">
                        <thead>
                            <tr>
                                <th class="text-left">
                                    @lang('crud.pemasok.inputs.nama_pemasok')
                                </th>
                                <th class="text-center">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pemasoks as $pemasok)
                                <tr>
                                    <td>{{ $pemasok->nama_pemasok ?? '-' }}</td>
                                    <td class="text-center" style="width: 134px;">
                                        <div role="group" aria-label="Row Actions" class="btn-group">
                                            @can('update', $pemasok)
                                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                    data-bs-target="#form-modal" data-mode="edit" data-id="{{ $pemasok->id }}">
                                                    <i class="icon ion-md-create"></i>
                                                </button>
                                            @endcan
                                            @can('delete', $pemasok)
                                            <form action="{{ route('pemasoks.destroy', $pemasok) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-light text-danger delete.btn">
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
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('app.pemasoks.form-inputs')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const object = JSON.stringify(@json($pemasoks))
            const data = JSON.parse(object).data

            $("#form-modal").on("show.bs.modal", event => {
                const btn = $(event.relatedTarget)
                const modal = $(this)
                let mode = $(btn).data("mode")
                switch (mode) {
                    case "add":
                        console.log("add")
                        modal.find(".modal-title").text("Tambah Data Pemasok")
                        modal.find("#method").html("")
                        setValue()
                        modal.find(".modal-body form").attr("action", `{{ url('pemasoks') }}`)
                        break;
                    case "edit":
                        const idPemasok = btn.data("id")
                        const pemasok = data.find(item => item.id == idPemasok)
                        modal.find(".modal-title").text("Edit Data Pemasok")
                        modal.find("#method").html(`@method('PUT')`)
                        setValue(pemasok.nama_pemasok)
                        modal.find(".modal-body form").attr("action", `{{ url('pemasoks') }}/${idPemasok}`)
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

            function setValue(namaPemasok = "") {
                const modalForm = $("#form-modal")

                modalForm.find("#nama_pemasok").val(namaPemasok)

                return true
            }
        })
    </script>
@endpush
