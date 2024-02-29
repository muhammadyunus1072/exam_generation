@inject('menuHelper', 'App\Helpers\MenuFilter')
{{-- <p class="text-light">
    @if (isset($item['submenu']))
    {{($item['submenu'][1]['text'])}}
    
    @else
    
    {{($item['text'])}}
    @endif
</p> --}}
@if ($menuHelper->transform($item))

@if (isset($item['submenu']))
    <!--begin:Menu item-->
    <div data-kt-menu-trigger="click" class="menu-item here show menu-accordion">
        <!--begin:Menu link-->
        <span class="menu-link">
            <span class="menu-icon">
                {!! $item['icon'] !!}
            </span>
            <span class="menu-title">{{$item['text']}}</span>
            <span class="menu-arrow"></span>
        </span>
        <!--end:Menu link-->
        <!--begin:Menu sub-->
        <div class="menu-sub menu-sub-accordion">
            @foreach ($item['submenu'] as $submenu)
                <!--begin:Menu item-->
                <div class="menu-item">
                    <!--begin:Menu link-->
                    <a class="menu-link {{ request()->routeIs($submenu['url'].".index") ? 'active' : '' }}" href="{{ route($submenu['url'].".index") }}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">{{$submenu['text']}}</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
            @endforeach
        </div>
        <!--end:Menu sub-->
    </div>
    <!--end:Menu item -->
@else

    <!--begin:Menu item-->
    <div class="menu-item">
        <!--begin:Menu link-->
        <a class="menu-link {{ request()->routeIs($item['url'].".index") ? 'active' : '' }}" href="{{ route($item['url'].".index") }}">
            <span class="menu-icon">
                {!! $item['icon'] !!}
            </span>
            <span class="menu-title">{{$item['text']}}</span>
        </a>
        <!--end:Menu link-->
    </div>
    <!--end:Menu item-->
@endif

@endif