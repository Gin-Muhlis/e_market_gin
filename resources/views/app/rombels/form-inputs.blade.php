@php $editing = isset($rombel) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12">
        <x-inputs.text
            name="rombel"
            label="Rombel"
            :value="old('rombel', ($editing ? $rombel->rombel : ''))"
            maxlength="255"
            placeholder="Rombel"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
