@php $editing = isset($transaksi) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="kode_transaksi"
            label="Kode Transaksi"
            :value="old('kode_transaksi', ($editing ? $transaksi->kode_transaksi : ''))"
            maxlength="255"
            placeholder="Kode Transaksi"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.date
            name="tgl_bayar"
            label="Tgl Bayar"
            value="{{ old('tgl_bayar', ($editing ? optional($transaksi->tgl_bayar)->format('Y-m-d') : '')) }}"
            max="255"
            required
        ></x-inputs.date>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="user_input"
            label="User Input"
            :value="old('user_input', ($editing ? $transaksi->user_input : ''))"
            maxlength="255"
            placeholder="User Input"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="rombel_id" label="Rombel" required>
            @php $selected = old('rombel_id', ($editing ? $transaksi->rombel_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Rombel</option>
            @foreach($rombels as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
