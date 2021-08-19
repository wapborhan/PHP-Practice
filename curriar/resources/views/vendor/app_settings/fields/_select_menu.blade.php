@php
        $fieldName = isset($field['multiple']) ? $field['name'].'[]' : $field['name'];
@endphp

<select name="{{ $fieldName }}"
        class="{{ Arr::get( $field, 'class', config('app_settings.input_class', 'form-control')) }} form-control selectpicker"
        @if(isset($field['multi'])) multiple @endif
        @if( $styleAttr = Arr::get($field, 'style')) style="{{ $styleAttr }}" @endif
        id="{{ $field['name'] }}"
        data-live-search="true" tabindex="null">
    @foreach($menus as $menu)
        <option value="{{ $menu->id }}" class="option_font" @if( old($field['name'], \setting($field['name'])) == $menu->id ) selected @endif>
                {{ $menu->name }}
        </option>
    @endforeach
</select>
