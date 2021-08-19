@component('app_settings::input_group', compact('field'))
    <div id="{{ Arr::get($field, 'id') }}-div" class="input-group" title="Using input value">
        <input type="text" 
                class="{{ Arr::get( $field, 'class', config('app_settings.input_class', 'form-control')) }} {{ $errors->has($field['name']) ? config('app_settings.input_invalid_class', 'is-invalid') : '' }} input-lg" 
                value="{{ old($field['name'], \setting($field['name'])) }}"
                name="{{ $field['name'] }}"
                @if( $placeholder = Arr::get($field, 'placeholder') )
                placeholder="{{ translate( $placeholder ) }}"
                @endif
                @if( $styleAttr = Arr::get($field, 'style')) style="{{ $styleAttr }}" @endif
                @if( $maxAttr = Arr::get($field, 'max')) max="{{ $maxAttr }}" @endif
                @if( $minAttr = Arr::get($field, 'min')) min="{{ $minAttr }}" @endif
                id="{{ Arr::get($field, 'id') }}"
               />
        <span class="input-group-append">
        <span class="input-group-text colorpicker-input-addon"><i></i></span>
        </span>
    </div>

    @if( $append = Arr::get($field, 'append'))
        <span>{{ translate( $append ) }}</span>
    @endif

@endcomponent
