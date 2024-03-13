@push('css')
    <script src="{{ asset('assets/plugins/custom/ckeditor/ckeditor5-41.2.0/build/ckeditor.js') }}"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism-okaidia.min.css" rel="stylesheet" />
    <style>
        .ck-content {
            min-height: 450px;
        }
        pre[class*="language-"] {
            font-family: Consolas, Monaco, 'Andale Mono', 'Ubuntu Mono', monospace;
            font-size: 14px;
            line-height: 1.5em;
            border-radius: 5px;
            background-color: #1e1e1e; /* Background color similar to VSCode */
            padding: 20px;
            overflow-x: auto;
        }

        .token.keyword,
        .token.selector,
        .token.important,
        .token.atrule {
            color: #d4d4d4; /* Keyword color similar to VSCode */
        }

        .token.property,
        .token.tag {
            color: #d19a66; /* Property/Tag color similar to VSCode */
        }

        .token.function {
            color: #89ddff; /* Function color similar to VSCode */
        }

        .token.comment,
        .token.prolog,
        .token.doctype,
        .token.cdata {
            color: #6a9955; /* Comment color similar to VSCode */
        }

        .token.string,
        .token.attr-value {
            color: #ce9178; /* String/Attribute value color similar to VSCode */
        }

        .token.punctuation {
            color: #d4d4d4; /* Punctuation color similar to VSCode */
        }

        .token.operator {
            color: #d4d4d4; /* Operator color similar to VSCode */
        }

        .token.number {
            color: #b5cea8; /* Number color similar to VSCode */
        }
    </style>
    {{-- <link href="{{ asset('assets/plugins/custom/prism/prism.css') }}" rel="stylesheet" /> --}}

@endpush
<div class="row">
    @can('create users')
        <div class="col-sm-12 mt-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
                <i class="fa fa-plus"></i>
                Create Documentation
            </button>
        </div>
    @endcan
    <h1>Example Fullscreen Modal</h1>
<pre><code class="language-plaintext">
    &lt;button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_2"&gt;
        Launch demo modal
    &lt;/button&gt;

    &lt;div class="modal bg-body fade" tabindex="-1" id="kt_modal_2"&gt;
        &lt;div class="modal-dialog modal-fullscreen"&gt;
            &lt;div class="modal-content shadow-none"&gt;
                &lt;div class="modal-header"&gt;
                    &lt;h5 class="modal-title"&gt;Modal title&lt;/h5&gt;
                    
                    <!--begin::Close-->
                    &lt;div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close"&gt;
                        &lt;i class="ki-duotone ki-cross fs-2x"&gt;&lt;span class="path1"&gt;&lt;/span&gt;&lt;span class="path2"&gt;&lt;/span&gt;&lt;/i&gt;
                    &lt;/div&gt;
                    <!--end::Close-->
                &lt;/div&gt;
                
                &lt;div class="modal-body"&gt;
                    &lt;p&gt;Modal body text goes here.&lt;/p&gt;
                &lt;/div&gt;
                
                &lt;div class="modal-footer"&gt;
                    &lt;button type="button" class="btn btn-light" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
                    &lt;button type="button" class="btn btn-primary"&gt;Save changes&lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
</code></pre>
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
                        <div>
                        </div>
                        <div class="mb-10">
                            <label class="form-label">URL</label>
                            <input type="text" class="form-control form-control-solid" name="url" wire:model.live="url" placeholder="URL"/>
                            @error('url') 
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
<script>
    // Initialize Prism.js line numbers
    document.addEventListener('DOMContentLoaded', function() {
        Prism.highlightAll();
    });
</script>
</script>
    <script>
        $(() => {
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
                console.log('Editor was initialized', editor);
                editor.model.document.on('change:data', () => {
                    // Get the updated content
                    const content = editor.getData();
                    @this.set('content', content);
                });
            })
            .catch(error => {
                console.error(error.stack);
            });
            initSelect2();

            $("#editModal").on('hide.bs.modal', function() {
                @this.call('resetInput');
                $('#select2-role').empty();
                $('#select2-role').select2('destroy').select2({
                    minimumInputLength: 1,
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

