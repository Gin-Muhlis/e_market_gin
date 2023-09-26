@php
    require_once app_path() . '/Helpers/helper.php';
@endphp

<table class="table table-borderless table-hover" id="myTable">
    <thead>
        <tr>
            <th class="text-center">
                No
            </th>
            <th class="text-left">
                @lang('crud.produk.inputs.nama_produk')
            </th>
            <th class="text-left">
                Dibuat
            </th>
            <th class="text-left">
                Diedit
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse($produks as $produk)
            <tr>
                <td class="text-center">{{ $loop->index + 1 }}</td>
                <td>{{ $produk->nama_produk ?? '-' }}</td>
                <td>{{ generateDate($produk->created_at->toDateString()) }}</td>
                <td>{{ generateDate($produk->updated_at->toDateString()) }}</td>
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