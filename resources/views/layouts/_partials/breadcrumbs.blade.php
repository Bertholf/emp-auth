@if (isset($breadcrumbs))
    <ol class="breadcrumb">
    @foreach ($breadcrumbs as $breadcrumb)
        @if (!$breadcrumb->last)
            <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{!! $breadcrumb->title !!}</a></li>
        @else
            <li class="breadcrumb-item active">{!! $breadcrumb->title !!}</li>
        @endif
    @endforeach
    </ol>
@endif
