@php
        $fieldName = isset($field['multiple']) ? $field['name'].'[]' : $field['name'];
@endphp

<select name="{{ $fieldName }}"
        class="{{ Arr::get( $field, 'class', config('app_settings.input_class', 'form-control')) }} form-control selectpicker"
        @if(isset($field['multi'])) multiple @endif
        @if( $styleAttr = Arr::get($field, 'style')) style="{{ $styleAttr }}" @endif
        id="{{ $field['name'] }}"
        data-live-search="true" tabindex="null">
    @foreach(Arr::get($field, 'options', []) as $val => $label)
        <option value="{{ $val }}" class="option_font" style="font-family: '{{ $val }}'" @if( old($field['name'], \setting($field['name'])) == $val ) selected @endif>
                {{ $label }}
        </option>
    @endforeach
</select>
