@php $editing = isset($tampungBayar) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="penjualan_id" label="Penjualan" required>
            @php $selected = old('penjualan_id', ($editing ? $tampungBayar->penjualan_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Penjualan</option>
            @foreach($penjualans as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="total"
            label="Total"
            :value="old('total', ($editing ? $tampungBayar->total : ''))"
            max="255"
            step="0.01"
            placeholder="Total"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="terima"
            label="Terima"
            :value="old('terima', ($editing ? $tampungBayar->terima : ''))"
            max="255"
            step="0.01"
            placeholder="Terima"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="kembali"
            label="Kembali"
            :value="old('kembali', ($editing ? $tampungBayar->kembali : ''))"
            max="255"
            step="0.01"
            placeholder="Kembali"
            required
        ></x-inputs.number>
    </x-inputs.group>
</div>
