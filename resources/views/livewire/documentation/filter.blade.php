@push('css')
    <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor5-41.2.0/build/ckeditor.js') }}"></script>
    <style>
        .ck-content {
            min-height: 450px;
        }
    </style>

@endpush
<div class="row">
    @can(PermissionHelper::transform(PermissionHelper::ACCESS_DOCUMENTATION, PermissionHelper::TYPE_CREATE))
        <div class="col-sm-12 mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fa fa-plus"></i>
                Create Documentation
            </button>
        </div>
    @endcan
    <div class="modal bg-body fade" tabindex="-1" id="editModal" wire:ignore.self>
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content shadow-none">
                <div class="modal-header">
                    <h5 class="modal-title">Data Documentation</h5>
    
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <i class="ki-duotone ki-cross fs-2x"><span class="path1"></span><span class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
    
                <form wire:submit="save">
                    <div class="modal-body">
                        <div class="mb-10">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control form-control-solid" name="name" wire:model.blur="name" placeholder="Name"/>
                            @error('name') 
                                <span class="text-danger">{{$message}}</span> 
                            @enderror 
                        </div>
                        <div class="mb-2" wire:ignore>
                            <textarea class="form-control" id="content"></textarea>
                        </div>

                        <div class="mb-2">
                            


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
            initEditor();
            function initEditor(){

                ClassicEditor
                .create(document.querySelector('#content'), {
                    toolbar: [
                        // 'heading', '|',
                        'bold', 'italic', 'underline', '|', // Basic styles
                        'link', 'bulletedList', 'numberedList', 'blockQuote', '|', // Text alignment
                        'indent', 'outdent', '|', // Indentation
                        'imageUpload', 'mediaEmbed', '|', // Media
                        'codeBlock', 'htmlEmbed', 'horizontalLine', '|', // Advanced features
                        'undo', 'redo', // Undo and redo
                        'fontSize', 'fontFamily', // Font size and family
                        'fontColor', // Text color and background color
                    ],
                })
                .then(editor => {
                    contentEditor = editor;
                    editor.model.document.on('change:data', () => {
                        // Get the updated content
                        const content = editor.getData();
                        @this.set('content', content);
                    });
                })
                .catch(error => {
                    console.error(error.stack);
                });
            }

            Livewire.on('editContent', (data) => {
                contentEditor.setData(data.content);
            })

            $("#editModal").on('hide.bs.modal', function() {
                @this.call('resetInput');
            });
        })
    </script>
@endpush

