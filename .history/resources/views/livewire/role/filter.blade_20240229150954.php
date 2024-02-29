<div class="row">
    <div class="col-sm-12 mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#roleModal">
            <i class="fa fa-plus"></i>
            Create Role
        </button>
    </div>

    <div class="modal fade" tabindex="-1" id="roleModal" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Data Role</h3>
    
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form wire:submit="saveRole">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label class="form-label">Role Name</label>
                            <input type="text" class="form-control form-control-solid" name="role_name" wire:model.blur="role_name" placeholder="Role Name" required/>
                            @error('role_name') 
                                <span class="text-danger">{{$message}}</span> 
                            @enderror 
                        </div>
                        <div class="w-100">
                            <div class="mb-10" wire:ignore>
                                <label class="form-label">Permission</label>
                                <select multiple="multiple" class="form-select" id="select2-permissions" name="select2-permissions[]" wire:ignore.self>
                                    {{-- @foreach($user->jenis_no_registers as $jenis_no_register)
                                        <option value="{{$jenis_no_register->id}}" selected>{{$jenis_no_register->jenis_no_register}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
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

            $("#roleModal").on('hide.bs.modal', function() {
                @this.call('resetInput');
            });
        })
        let permissions = [
            { id: 1, text: 'Option 1' },
            { id: 3, text: 'Option 3' },
            { id: 5, text: 'Option 5' }
        ];
        function initSelect2(){
            $('#select2-permissions').select2({
                minimumInputLength: 1,
                dropdownParent: $('#roleModal'),
                width: '100%',
                theme: 'bootstrap5',
                placeholder: "Choose Permissions",
                ajax: {
                    url: "{{ route('roles.get.permissions') }}",
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
            $("#select2-permissions").on("select2:select", (e) => {
                let data = e.params.data
                @this.set('role', data.text);
                console.log(@this.role)
            })
            $("#select2-permissions").on("select2:unselect", (e) => {
                let data = e.params.data;
                console.log(data.text)

            });
            permissions.forEach(permission => {
                // Find option element by value and set selected attribute
                $('#select2-permissions option[value="' + permission.id + '"]').prop('selected', true);
            });
        }
        Livewire.on('addSelect2Role', (data) => {
            // let role = data.role[0];
            // $('#select2-permissions').data('select2').$container.find('.select2-selection__placeholder').text(role);
            // console.log(@this.role)
        });
        Livewire.on('initSelect2', (data) => {
            initSelect2();
        });
    </script>
@endpush

