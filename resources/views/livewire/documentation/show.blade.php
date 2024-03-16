@push('css')
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/prism-okaidia.min.css') }}" data-noprefix />
@endpush
<div class="d-flex flex-column flex-md-row rounded border p-10">
    
    {{-- {{dd($documentation)}} --}}
    {{-- {{dd($documentation_id)}}  --}}
    <ul class="nav nav-tabs nav-pills border-0 flex-row flex-md-column me-5 mb-3 mb-md-0 fs-6" role="tablist">
        @foreach ($documentation_menus as $documentation_menu)
            <li class="nav-item w-md-200px me-0" role="presentation">
                <a wire:click="show('{{$documentation_menu->id}}')" class="nav-link {{($documentation_menu->id == $documentation_id) ? 'active' : ''}}" data-bs-toggle="tab" tabindex="-1">{{$documentation_menu->name}}</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade active show border" id="kt_vtab_pane_3" role="tabpanel">
            {!! $documentation_content !!}
        </div>
    </div>
</div>


@push('js')
    <script src="{{ asset('assets/vendor/utopia.js')}}"></script>
    <script src="{{ asset('components/prism-core.js')}}"></script>
    <script src="{{ asset('assets/plugins/autoloader/prism-autoloader.js') }}" data-autoloader-path="{{ asset('components')}}/"></script>
    <script>
    Prism.plugins.autoloader.use_minified = false;
    </script>
    <script src="{{ asset('components.js')}}"></script>
    <script src="{{ asset('assets/code.js')}}"></script>
    <script src="{{ asset('assets/vendor/promise.js')}}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            highlightAllPrism();
        });
        function highlightAllPrism(){
            Prism.highlightAll();
        }
        Livewire.on('highlightCode', () => {
            setTimeout(() => {
                highlightAllPrism();
            }, 100);
        });

    </script>
@endpush



