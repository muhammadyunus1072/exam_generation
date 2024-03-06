@inject('menuHelper', 'App\Helpers\MenuFilter')
{{-- {{dd($menuHelper->transform($item))}} --}}
@if ($menuHelper->transform($item))
@endif