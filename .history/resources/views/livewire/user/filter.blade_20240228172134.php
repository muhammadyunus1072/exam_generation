<div class="row">
    <div class="col-sm-12 mt-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
            <i class="fa fa-plus"></i>
            Tambah Data
        </button>
    </div>

    <div class="modal fade" tabindex="-1" id="createModal">
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
    
                <div class="modal-body">
                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Name</label>
                        <input type="text" class="form-control form-control-solid" placeholder="Name"/>
                    </div>
                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Email</label>
                        <input type="email" class="form-control form-control-solid" placeholder="Email"/>
                    </div>
                    <div class="mb-10">
                        <label for="exampleFormControlInput1" class="required form-label">Password</label>
                        <input type="email" class="form-control form-control-solid" placeholder="Email"/>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    
</div>

