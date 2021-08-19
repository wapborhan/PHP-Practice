@extends('backend.layouts.app')

@section('content')

<div class="mb-3 row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{ translate('Default Language') }}</h5>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('env_key_update.update') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label class="col-from-label">{{ translate('Default Language') }}</label>
                        </div>
                        <input type="hidden" name="types[]" value="DEFAULT_LANGUAGE">
                        <div class="col-lg-6">
                            <select class="form-control kt-select2 default-language" name="DEFAULT_LANGUAGE">
                                @foreach (\App\Language::all() as $key => $language)
                                    <option value="{{ $language->code }}" <?php if(env('DEFAULT_LANGUAGE') == $language->code) echo 'selected'?> >{{ $language->name }}</option>                             
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-info">{{translate('Save')}}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="mt-2 mb-3 text-left aiz-titlebar">
	<div class="align-items-center">
		<div class="text-md-right">
			<a href="{{ route('languages.create') }}" class="btn btn-circle btn-primary">
				<span>{{translate('Add New Language')}}</span>
			</a>
			<a href="{{ route('languages.import') }}" class="btn btn-circle btn-info">
				<span>{{translate('Import Translations To Language')}}</span>
			</a>
		</div>
	</div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0 h6">{{translate('Language')}}</h5>
    </div>
    <div class="card-body">
        <table class="table mb-0 aiz-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{translate('Name')}}</th>
                    <th>{{translate('Code')}}</th>
                    <th>{{translate('RTL')}}</th>
                    <th class="text-right" width="15%">{{translate('Options')}}</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($languages as $key => $language)
                    <tr>
                        <td>{{ ($key+1) + ($languages->currentPage() - 1)*$languages->perPage() }}</td>
                        <td>{{ $language->name }}</td>
                        <td>{{ $language->code }}</td>
                        <td>
                            <label class="checkbox">
                                <input type="checkbox" onchange="update_rtl_status(this)" value="{{ $language->id }}" <?php if($language->rtl == 1) echo "checked";?> />
                                <span></span>
                            </label>
                        </td>
                        <td class="text-right">
                            <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{route('languages.show', encrypt($language->id))}}" title="{{ translate('Translation') }}">
                                <i class="las la-language"></i>
                            </a>
                            <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{route('languages.edit', encrypt($language->id))}}" title="{{ translate('Edit') }}">
                                <i class="las la-edit"></i>
                            </a>
                            @if($language->code != 'en')
                                <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('languages.destroy', $language->id)}}" title="{{ translate('Delete') }}">
                                    <i class="las la-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div class="aiz-pagination">
            {{ $languages->appends(request()->input())->links() }}
        </div>
    </div>
</div>

@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection


@section('script')
<script type="text/javascript">
        function update_rtl_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
            $.post('{{ route('languages.update_rtl_status') }}', {_token:'{{ csrf_token() }}', id:el.value, status:status}, function(data){
                if(data == 1){
                    location.reload();
                }
                else{
                    AIZ.plugins.notify('danger', '{{ translate('Something went wrong') }}');
                }
            });
        }

        $('.default-language').select2({
          placeholder: 'Select Language',
          language: {
            noResults: function() {
              return `<li style='list-style: none; padding: 10px;'><a style="width: 100%" href="{{route('languages.create')}}?redirect=admin.languages"
                class="btn btn-primary" >Manage {{translate('Languages')}}</a>
                </li>`;
            },
          },
          escapeMarkup: function(markup) {
            return markup;
          },
        });
</script>
@endsection
