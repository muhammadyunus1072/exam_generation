@inject('menuHelper', 'App\Helpers\MenuFilter')
{{-- {{dd($item['text'])}} --}}
@if ($menuHelper->transform($item))

@if (isset($item['submenu']))
@else
    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link" href="https://preview.keenthemes.com/metronic8/demo1/layout-builder.html">
            <span class="menu-icon">
                <i class="ki-duotone ki-abstract-13 fs-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
            </span>
            <span class="menu-title">Layout Builder</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
@endif

@endif