<div class="row">
    <div class="col-sm-12 mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#permissionModal">
            <i class="fa fa-plus"></i>
            Create Permission
        </button>
    </div>
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
                            <input type="text" class="form-control form-control-solid" name="permission_name" wire:model.blur="permission_name" placeholder="Permission Name" required/>
                            @error('permission_name') 
                                <span class="text-danger">{{$message}}</span> 
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
    
</div>


@push('js')
    <script>
        $(() => {
            initSelect2();

            $("#editModal").on('hide.bs.modal', function() {
                @this.call('resetInput');
            });
        })

        function initSelect2(){
            $('#select2-role').select2({
                minimumInputLength: 0,
                dropdownParent: $('#editModal'),
                width: '100%',
                theme: 'bootstrap5',
                placeholder: "Choose Role",
                ajax: {
                    url: "{{ route('users.get.roles') }}",
                    dataType: "json",
                    type: "GET",
                    data: function(params) {
                        return {
                            search: params.term,
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    "id": item.id,
                                    "text": item.text,
                                }
                            })
                        };
                    },
                }
            });
            $("#select2-role").on("select2:select", (e) => {
                let data = e.params.data
                @this.set('role', data.text);
                console.log(@this.role)
            })
        }
        Livewire.on('addSelect2Role', (data) => {
            let role = data.role[0];
            $('#select2-role').data('select2').$container.find('.select2-selection__placeholder').text(role);
            console.log(@this.role)
        });
        Livewire.on('initSelect2', (data) => {
            initSelect2();
        });
    </script>
@endpush

