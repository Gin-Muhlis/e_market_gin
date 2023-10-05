
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
                                name="name"
                                label="Name"
                                :value="old('name', ($editing ? $user->name : ''))"
                                maxlength="255"
                                placeholder="Name"
                                required
                                id="name"
                            ></x-inputs.text>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.email
                                name="email"
                                label="Email"
                                :value="old('email', ($editing ? $user->email : ''))"
                                maxlength="255"
                                placeholder="Email"
                                required
                                id="email"
                            ></x-inputs.email>
                        </x-inputs.group>
                    
                        <x-inputs.group class="col-sm-12">
                            <x-inputs.password
                                name="password"
                                label="Password"
                                maxlength="255"
                                placeholder="Password"
                            ></x-inputs.password>
                        </x-inputs.group>
                    
                        <div class="form-group col-sm-12 mt-4">
                            <h4>Assign @lang('crud.roles.name')</h4>
                    
                            @foreach ($roles as $role)
                            <div>
                                <x-inputs.checkbox
                                    id="role{{ $role->id }}"
                                    name="roles[]"
                                    label="{{ ucfirst($role->name) }}"
                                    value="{{ $role->id }}"
                                    :checked="isset($user) ? $user->hasRole($role) : false"
                                    :add-hidden-value="false"
                                ></x-inputs.checkbox>
                                <div class="form-check">
                                </div>
                            </div>
                            @endforeach
                        </div>
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
