@extends('layouts.app')

@push('styles')
    <style>
        .icon {
            width: 40px;
            height: 40px;
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
            cursor: pointer
        }

        .text {
            height: 40px;
            padding-left: 8px;
            border: 1px solid rgba(0, 0, 0, .2);
            color: #08080850;

            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .text span {
            line-height: 40px;
        }

        .button-transaksi {
            width: 100%;
            padding-block: 8px;
        }

        .btn-qty,
        .btn-delete {
            cursor: pointer
        }

        .loader {
            width: 1rem;
            height: 1rem;
        }
    </style>
@endpush
@section('content')
    <div class="container">

        <div class="card">
            <div class="card-body">
                <h4>Pembelian Barang</h4>
                <div class="row">
                    <div class="col-md-8">
                        <table class="table w-100">
                            <thead>
                                <tr class="bg-primary">
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center">QTY</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-data-barang">
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 bg-successs">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex align-items-center">
                                <h5>Detail</h5>
                            </div>
                            <div class="card-body">
                                <label for="form-label">Pilih Barang</label>
                                <div class="d-flex align-iitems-center justify-content-start w-100 mb-3">
                                    <div class="icon d-flex align-items-center justify-content-center bg-primary"
                                        data-bs-toggle="modal" data-bs-target="#data-barang-modal">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="text w-100">
                                        <span>Cari Barang</span>
                                    </div>
                                </div>
                                <label for="form-label">Pilih Pemasok</label>
                                <div class="d-flex align-iitems-center justify-content-start w-100 mb-3">
                                    <div class="icon d-flex align-items-center justify-content-center bg-primary"
                                        data-bs-toggle="modal" data-bs-target="#data-pemasok-modal">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <div class="text w-100 text-pemasok">
                                        <span>Cari Pemasok</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center justify-content-between my-3">
                                    <span>Total</span>
                                    <span id="total-transaksi">Rp. 0</span>
                                </div>
                                <button class="btn w-100 btn-primary text-white rounded btn-tambah-transaksi">
                                    <div class="spinner-border text-light d-none loader" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                    <span class="text-add-transaksi">Tambah Transaksi</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('app.pembelians.data')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const objectString = JSON.stringify(@json($barang));
            const dataBarang = JSON.parse(objectString)
            const dataTransaksi = {
                totalTransaksi: 0,
                pemasok: null,
                barang: []
            };
            const objectStringPemasok = JSON.stringify(@json($pemasok));
            const dataPemasok = JSON.parse(objectStringPemasok)

            let choicedPemasok = null;
            let choicedBarang = []
            let id;

            $(".btn-plus-barang").on("click", addChoicedBarang)
            $(".btn-plus-pemasok").on("click", addChoicedPemasok)
            $(".btn-tambah-transaksi").on("click", addTransaksi)

            function addChoicedBarang(event) {
                const btn = event.target

                id = $(btn).data("id")

                let barang = dataBarang.find(barang => barang.id == id)

                if (choicedBarang.find(item => item.barang.id == id)) {
                    let alreadyBarang = choicedBarang.find(item => item.barang.id == id)

                    alreadyBarang.qty += 1
                    alreadyBarang.subTotal = alreadyBarang.qty * alreadyBarang.barang.harga_jual
                } else {
                    let dataChoiced = {
                        qty: 1,
                        barang: barang,
                        subTotal: barang.harga_jual
                    }
                    choicedBarang.push(dataChoiced)
                }

                showDataBarang()

                $("#data-barang-modal").modal("hide")

                return true
            }

            function showDataBarang() {
                let markup = ``;
                let totalTransaksi = 0;
                choicedBarang.forEach(item => {
                    totalTransaksi += item.subTotal
                    markup += `<tr>
                        <td>${item.barang.kode_barang}</td>
                        <td>${item.barang.nama_barang}</td>
                        <td class="text-center">${item.barang.harga_jual}</td>
                        <td class="d-flex align-items-start justify-content-center gap-3 colomn-qty">
                            <span class="min-qty btn-qty fw-bold text-warning fs-6 ${item.qty <= 1 ? "d-none" : ""}" data-id="${item.barang.id}">-</span>
                            <span>${item.qty}</span>
                            <span class="plus-qty btn-qty fw-bold text-primary fs-6" data-id="${item.barang.id}">+</span>
                        </td>
                        <td class="text-center">${item.subTotal}</td>
                        <td class="text-center" >
                            <i class="fas fa-trash-alt text-danger fs-6 cursor-pointer btn-delete" data-id="${item.barang.id}"></i>
                        </td>
                        </tr>`
                })

                dataTransaksi.totalTransaksi = totalTransaksi

                let totalTransaksiFormat = Intl.NumberFormat("id-ID", {
                    style: "currency",
                    currency: "IDR",
                }).format(totalTransaksi);

                $("#table-data-barang").html(markup)
                $("#total-transaksi").text(totalTransaksiFormat)

                runQuantity()
                deleteBarang()
            }

            function runQuantity() {
                $(".colomn-qty").on("click", (event) => {
                    let target = event.target

                    let idColomn

                    if ($(target).hasClass("min-qty")) {
                        idColomn = $(target).data("id")
                        subtractQuantity(idColomn, target)
                    }

                    if ($(target).hasClass("plus-qty")) {
                        idColomn = $(target).data("id")
                        plusQuantity(idColomn)
                    }
                })

                return true
            }


            function subtractQuantity(id, btn) {
                let dataChoiced = choicedBarang.find(item => item.barang.id == id)

                let quantity = dataChoiced.qty

                quantity -= 1

                dataChoiced.qty = quantity
                dataChoiced.subTotal = quantity * dataChoiced.barang.harga_jual

                if (quantity <= 1) {
                    $(btn).addClass("d-none")
                    showDataBarang()
                    return
                }

                showDataBarang()

                return true
            }

            function plusQuantity(id) {
                let dataChoiced = choicedBarang.find(item => item.barang.id == id)

                let quantity = dataChoiced.qty

                quantity += 1

                dataChoiced.qty = quantity
                dataChoiced.subTotal = quantity * dataChoiced.barang.harga_jual

                showDataBarang()

                return true
            }

            function deleteBarang() {
                $(".btn-delete").on("click", (event) => {
                    let target = event.target

                    if ($(target).hasClass("btn-delete")) {
                        let id = $(target).data("id")

                        choicedBarang = choicedBarang.filter(item => item.barang.id !== id)

                        showDataBarang()
                    }
                })
            }

            function addChoicedPemasok(event) {
                const btn = event.target

                let id = $(btn).data("id")

                choicedPemasok = dataPemasok.find(item => item.id === id)

                dataTransaksi.pemasok = choicedPemasok.id

                $(".text-pemasok").html(
                    `<span style="color: #080808;">${choicedPemasok.nama_pemasok}</span>`)

                $("#data-pemasok-modal").modal("hide")

                return true
            }

            function addTransaksi(event) {
                $('.loader').removeClass('d-none')
                $('.text-add-transaksi').addClass('d-none')

                dataTransaksi.barang = choicedBarang
                if (dataTransaksi.barang.length < 1 || dataTransaksi.pemasok == null) {
                    Swal.fire({
                        text: `Silahkan Pilih ${dataTransaksi.barang.length < 1 ? 'Barang' : 'Pemasok'} Terlebih Dahulu`,
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                    }).then(result => {
                        $('.loader').addClass('d-none')
                        $('.text-add-transaksi').removeClass('d-none')
                        Swal.close()
                    })
                    return
                }

                $.ajaxSetup({
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                })

                $.ajax({
                    url: `make-pembelian`,
                    method: 'POST',
                    data: dataTransaksi,
                    success: successTransaksi,
                    error: errorTransaksi
                })

                return true
            }

            function successTransaksi(response) {
                console.log(response)
                $('.loader').addClass('d-none')
                $('.text-add-transaksi').removeClass('d-none')

                choicedBarang.length = 0

                showDataBarang()

                let width = 850;
                let height = 500;
                let left = (window.innerWidth - width) / 2;
                let top = (window.innerHeight - height) / 2;
                

                let newWindow = window.open(`{{ config('app.url') }}/pembelian/faktur/${response.pembelian.id}`,
                    '_blank', `width=${width}, height=${height}, left=${left}, top=${top}`);

                newWindow.focus()


            }

            function errorTransaksi(response) {
                console.log(response)
                $('.loader').addClass('d-none')
                $('.text-add-transaksi').removeClass('d-none')

                const result = response.responseJSON

                choicedBarang.length = 0
                showDataBarang()

                Swal.fire({
                    text: result.message,
                    icon: "warning",
                    confirmButtonColor: "#3085d6",
                }).then(result => {
                    if (result.isConfirmed)
                        Swal.close()
                })

                return true
            }
        })
    </script>
@endpush
