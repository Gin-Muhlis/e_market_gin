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
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td class="text-center">{{ $item->kode_masuk }}</td>
                <td class="text-center">{{ $item->pemasok->nama_pemasok }}</td>
                <td class="text-center">{{ $item->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
