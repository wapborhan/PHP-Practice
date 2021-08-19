@if( $label = Arr::get($field, 'label') )
    <label for="{{ Arr::get($field, 'name') }}">{{ translate( $label ) }}</label>
@endif
