<div class="row">
    <div class="col-sm-12 mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="fa fa-plus"></i>
            Tambah Data
        </button>
        <div class="mb-10" wire:ignore>
            <label class="form-label">Role</label>
            
            <select class="form-select select2 select2-role">
                <option></option>
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
            </select>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" id="editModal" wire:ignore.self>
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
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" wire:model.live="is_verified" />
                            <label class="form-check-label" for="flexCheckDefault">
                                Is Verified?
                            </label>
                        </div>

                        <div class="w-100 {{($is_verified)?'d-block':'d-none';}}">
                            <div class="mb-10" wire:ignore>
                                <label class="form-label">Role</label>
                                
                                <select class="form-select select2 select2-role">
                                    
                                </select>
                            </div>
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


@push('js')
    <script>
        $(() => {
            initSelect2();
        })

        function initSelect2(){
            console.log('inited')
            // $('.select2').select2({
            //     theme: 'bootstrap4'
            // });
            $('.select2-role').select2({
                minimumInputLength: 1,
                // dropdownParent: $('#editModal'),
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
                        console.log(data)
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
            $(".select2-role").on("select2:select", (e) => {
                let data = e.params.data
                console.log(data)
                // @this.call('setFilterDiagnosa', data.id_icd10, data.kelas);
            })
        }

        Livewire.on('initSelect2', (data) => {
            initSelect2();
        });
    </script>
@endpush

