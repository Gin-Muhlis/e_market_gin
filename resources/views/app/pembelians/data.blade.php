<!-- Modal -->
<div class="modal fade" id="data-barang-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Barang</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <table class="table w-100" id="myTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->harga_jual }}</td>
                        <td>
                            <button class="btn btn-primary btn-plus-barang fw-bold" data-id="{{ $item->id }}">
                                +
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="data-pemasok-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Pemasok</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table w-100" id="myTable">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($pemasok as $item)
                  <tr>
                      <td>{{ $loop->index + 1 }}</td>
                      <td>{{ $item->nama_pemasok }}</td>
                      <td>
                          <button class="btn btn-primary btn-plus-pemasok fw-bold" data-id="{{ $item->id }}">
                              +
                          </button>
                      </td>
                  </tr>
              @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>