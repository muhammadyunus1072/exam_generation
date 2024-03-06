@inject('menuHelper', 'App\Helpers\MenuFilter')
{{$menuHelper->transform($item)}}
{{-- @if ($menuHelper->transform($item))
    
@endif --}}