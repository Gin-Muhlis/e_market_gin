@php $editing = isset($barang) @endphp


<div class="modal fade" id="form-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    @csrf
                    <div id="method">
                     
                    </div>
                    <div class="row">
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text
                                name="kode_barang"
                                label="Kode Barang"
                                :value="old('kode_barang', ($editing ? $barang->kode_barang : ''))"
                                maxlength="50"
                                placeholder="Kode Barang"
                                required
                                id="kode_barang"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text
                                name="nama_barang"
                                label="Nama Barang"
                                :value="old('nama_barang', ($editing ? $barang->nama_barang : ''))"
                                maxlength="100"
                                placeholder="Nama Barang"
                                required
                                id="nama_barang"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text
                                name="satuan"
                                label="Satuan"
                                :value="old('satuan', ($editing ? $barang->satuan : ''))"
                                maxlength="10"
                                placeholder="Satuan"
                                required
                                id="satuan"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.number
                                name="harga_jual"
                                label="Harga Jual"
                                :value="old('harga_jual', ($editing ? $barang->harga_jual : ''))"
                    
                                step="0.01"
                                placeholder="Harga Jual"
                                required
                                id="harga_jual"
                            ></x-inputs.number>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.number
                                name="stok"
                                label="Stok"
                                :value="old('stok', ($editing ? $barang->stok : ''))"
                         
                                placeholder="Stok"
                                required
                                id="stok"
                            ></x-inputs.number>
                        </x-inputs.group>
                    
            
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.select name="produk_id" label="Produk" required id="produk">
                                @php $selected = old('produk_id', ($editing ? $barang->produk_id : '')) @endphp
                                <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the Produk</option>
                                @foreach($produks as $value => $label)
                                <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
                                @endforeach
                            </x-inputs.select>
                        </x-inputs.group>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
