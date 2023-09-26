@php $editing = isset($detailTransaksi) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.number
            name="jumlah_bayar"
            label="Jumlah Bayar"
            :value="old('jumlah_bayar', ($editing ? $detailTransaksi->jumlah_bayar : ''))"
            max="255"
            step="0.01"
            placeholder="Jumlah Bayar"
            required
        ></x-inputs.number>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select name="transaksi_id" label="Transaksi" required>
            @php $selected = old('transaksi_id', ($editing ? $detailTransaksi->transaksi_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Transaksi</option>
            @foreach($transaksis as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.select
            name="jenis_pembayaran_id"
            label="Jenis Pembayaran"
            required
        >
            @php $selected = old('jenis_pembayaran_id', ($editing ? $detailTransaksi->jenis_pembayaran_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Jenis Pembayaran</option>
            @foreach($jenisPembayarans as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
