<div class="modal fade" tabindex="-1" id="permissionModal" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Data Permission</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <form wire:submit="savePermission">
                <div class="modal-body">
                    <div class="mb-10">
                        <label class="form-label">Permission Name</label>
                        <input type="text" class="form-control form-control-solid" name="permission_name"
                            wire:model.blur="permission_name" placeholder="Permission Name" required />
                        @error('permission_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
