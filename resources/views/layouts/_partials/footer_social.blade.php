@if(is_array(config('social.links')))
@foreach(config('social.links') as $key => $value)
<a href="{{ $value['url'] }}" target="_blank">
    <i class="fab fa-{{ $key }}" aria-hidden="true"></i>
</a>
@endforeach
@endif
