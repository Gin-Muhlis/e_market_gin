@php $editing = isset($detailPembelian) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="harga_beli"
            label="Harga Beli"
            :value="old('harga_beli', ($editing ? $detailPembelian->harga_beli : ''))"
            max="255"
            step="0.01"
            placeholder="Harga Beli"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="jumlah"
            label="Jumlah"
            :value="old('jumlah', ($editing ? $detailPembelian->jumlah : ''))"
            max="255"
            placeholder="Jumlah"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="sub_total"
            label="Sub Total"
            :value="old('sub_total', ($editing ? $detailPembelian->sub_total : ''))"
            max="255"
            step="0.01"
            placeholder="Sub Total"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="pembelian_id" label="Pembelian" required>
            @php $selected = old('pembelian_id', ($editing ? $detailPembelian->pembelian_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Pembelian</option>
            @foreach($pembelians as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="barang_id" label="Barang" required>
            @php $selected = old('barang_id', ($editing ? $detailPembelian->barang_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Barang</option>
            @foreach($barangs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
