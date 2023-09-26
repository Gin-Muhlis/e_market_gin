@php $editing = isset($penjualan) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="no_faktur"
            label="No Faktur"
            :value="old('no_faktur', ($editing ? $penjualan->no_faktur : ''))"
            maxlength="50"
            placeholder="No Faktur"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="tgl_faktur"
            label="Tgl Faktur"
            value="{{ old('tgl_faktur', ($editing ? optional($penjualan->tgl_faktur)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total_bayar"
            label="Total Bayar"
            :value="old('total_bayar', ($editing ? $penjualan->total_bayar : ''))"
            max="255"
            step="0.01"
            placeholder="Total Bayar"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="pelanggan_id" label="Pelanggan" required>
            @php $selected = old('pelanggan_id', ($editing ? $penjualan->pelanggan_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Pelanggan</option>
            @foreach($pelanggans as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="user_id" label="User" required>
            @php $selected = old('user_id', ($editing ? $penjualan->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
