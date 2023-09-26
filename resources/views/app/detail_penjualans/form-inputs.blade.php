@php $editing = isset($detailPenjualan) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="harga_jual"
            label="Harga Jual"
            :value="old('harga_jual', ($editing ? $detailPenjualan->harga_jual : ''))"
            max="255"
            step="0.01"
            placeholder="Harga Jual"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="jumlah"
            label="Jumlah"
            :value="old('jumlah', ($editing ? $detailPenjualan->jumlah : ''))"
            max="255"
            placeholder="Jumlah"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="sub_total"
            label="Sub Total"
            :value="old('sub_total', ($editing ? $detailPenjualan->sub_total : ''))"
            max="255"
            step="0.01"
            placeholder="Sub Total"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="penjualan_id" label="Penjualan" required>
            @php $selected = old('penjualan_id', ($editing ? $detailPenjualan->penjualan_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Penjualan</option>
            @foreach($penjualans as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="barang_id" label="Barang" required>
            @php $selected = old('barang_id', ($editing ? $detailPenjualan->barang_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Silahkan Pilih Barang</option>
            @foreach($barangs as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
