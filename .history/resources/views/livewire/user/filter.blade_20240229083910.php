<div class="row">
    <div class="col-sm-12 mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fa fa-plus"></i>
            Tambah Data
        </button>
    </div>

    <div class="modal fade" tabindex="-1" id="createModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Data User</h3>
    
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Name</label>
                            <input type="text" class="form-control form-control-solid" autocomplete="off" wire:model.blur="name" placeholder="Name"/>
                            @error('name') 
                                <span class="text-danger">{{$message}}</span> 
                            @enderror 
                        </div>
                        <div>
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Email</label>
                            <input type="email" class="form-control form-control-solid" autocomplete="off" wire:model.blur="email" placeholder="Email"/>
                            @error('email') 
                                <span class="text-danger">{{$message}}</span> 
                            @enderror 
                        </div>
                        <div class="mb-10">
                            <label for="exampleFormControlInput1" class="required form-label">Password</label>
                            <input type="password" class="form-control form-control-solid" autocomplete="off" wire:model.blur="password" placeholder="Email"/>
                            @error('password') 
                                <span class="text-danger">{{$message}}</span> 
                            @enderror 
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" wire:model.blur="is_verified" />
                            <label class="form-check-label" for="flexCheckDefault">
                                Is Verified?
                            </label>
                        </div>
                        <div class="mb-10 {{($is_verified) ? '' : 'd-none'}}" wire:ignore>
                            <label for="exampleFormControlInput1" class="required form-label">Role</label>
                            
                            <select class="form-select" data-control="select2" data-placeholder="Select an option">
                                <option></option>
                                <option value="1">Option 1</option>
                                <option value="2">Option 2</option>
                            </select>
                        </div>
                    </div>
                    {{$is_verified?'Verif':'NOT';}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>

