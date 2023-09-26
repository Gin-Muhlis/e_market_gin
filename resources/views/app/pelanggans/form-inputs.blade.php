@php $editing = isset($pelanggan) @endphp




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
                                name="kode_pelanggan"
                                label="Kode Pelanggan"
                                :value="old('kode_pelanggan', ($editing ? $pelanggan->kode_pelanggan : ''))"
                                maxlength="50"
                                placeholder="Kode Pelanggan"
                                required
                                id="kode_pelanggan"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text
                                name="nama"
                                label="Nama"
                                :value="old('nama', ($editing ? $pelanggan->nama : ''))"
                                maxlength="50"
                                placeholder="Nama"
                                required
                                id="nama"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text
                                name="alamat"
                                label="Alamat"
                                :value="old('alamat', ($editing ? $pelanggan->alamat : ''))"
                                maxlength="200"
                                placeholder="Alamat"
                                required
                                id="alamat"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.text
                                name="no_telp"
                                label="No Telp"
                                :value="old('no_telp', ($editing ? $pelanggan->no_telp : ''))"
                                maxlength="20"
                                placeholder="No Telp"
                                required
                                id="no_telp"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.email
                                name="email"
                                label="Email"
                                :value="old('email', ($editing ? $pelanggan->email : ''))"
                                maxlength="50"
                                placeholder="Email"
                                required
                                id="email"
                            ></x-inputs.email>
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
