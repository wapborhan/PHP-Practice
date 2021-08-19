@extends('backend.layouts.app')

@section('subheader')
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
        <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
            <!--begin::Info-->
            <div class="d-flex align-items-center flex-wrap mr-1">
                <!--begin::Page Heading-->
                <div class="d-flex align-items-baseline flex-wrap mr-5">
                    <!--begin::Page Title-->
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Edit Role Information') }} ({{ $role->getTranslation('name', $lang) }})</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('roles.index')}}" class="text-muted">{{ translate('Roles')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Edit Role Information') }} ({{ $role->getTranslation('name', $lang) }})</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page Heading-->
            </div>
            <!--end::Info-->
        </div>
    </div>
    <!--end::Subheader-->
@endsection

@section('content')

<div class="row">
    <div class="col-md-12 mx-auto">

		<!--begin::Card-->
		<div class="card card-custom gutter-b example example-compact">
			<div class="card-header card-header-tabs-line">
				<div class="card-title">
					<h3 class="card-label">{{ translate('Edit Role Information') }} ({{ $role->getTranslation('name', $lang) }})</h3>
				</div>
				<div class="card-toolbar">
					<ul class="nav nav-tabs nav-bold nav-tabs-line">
						
						@foreach (\App\Language::all() as $key => $language)
							<li class="nav-item">
								<a class="nav-link @if ($language->code == $lang) active @endif" href="{{ route('roles.edit', ['id'=>$role->id, 'lang'=> $language->code] ) }}" href="#kt_tab_pane_1_3">
									<span class="nav-icon">
										<img src="{{ static_asset('assets/img/flags/'.$language->code.'.svg') }}" height="11" class="mr-1">
									</span>
									<span class="nav-text">{{$language->name}}</span>
								</a>
							</li>
						@endforeach
					</ul>
				</div>
			</div>

			<form class="form" action="{{ route('roles.update', $role->id) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
                <input name="_method" type="hidden" value="PATCH">
                <input type="hidden" name="lang" value="{{ $lang }}">
                @csrf
				<div class="card-body">
                    <div class="form-group">
                        <label>{{translate('Name')}} <span class="text-danger">*</span></label>
                        <div class="input-group input-group-solid">
                            <input type="text" placeholder="{{translate('Name')}}" id="name" name="name" class="form-control" value="{{ $role->getTranslation('name', $lang) }}" required>
                        </div>
                    </div>

                    <div class="card card-custom gutter-b example example-compact">
                        <div class="card-header card-header-tabs-line">
                            <div class="card-title">
                                <h3 class="card-label">{{ translate('Permissions') }}</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @php
                                $permissions = json_decode($role->permissions);
                            @endphp
                            <div class="form-group row">
                                <div class="col-sm-12 checkbox-list">

                                    @foreach(\File::files(base_path('resources/views/backend/permissions/')) as $path)
                                        @include('backend.permissions.'.str_replace('.blade','',pathinfo($path)['filename']))
                                    @endforeach
                                    
                                    
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]" value="10" @php if(in_array(10, $permissions)) echo "checked"; @endphp />
                                        <span></span>{{ translate('Reports') }}
                                    </label>
                                    
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]" value="12" @php if(in_array(12, $permissions)) echo "checked"; @endphp />
                                        <span></span>{{ translate('Support') }}
                                    </label>
                                    
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]" value="13" @php if(in_array(13, $permissions)) echo "checked"; @endphp />
                                        <span></span>{{ translate('Website Setup') }}
                                    </label>
                                    
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]" value="14" @php if(in_array(14, $permissions)) echo "checked"; @endphp />
                                        <span></span>{{ translate('Setup & Configurations') }}
                                    </label>
                                    
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]" value="20" @php if(in_array(20, $permissions)) echo "checked"; @endphp />
                                        <span></span>{{ translate('Staffs') }}
                                    </label>
                                    
                                    <label class="checkbox">
                                        <input type="checkbox" name="permissions[]" value="21" @php if(in_array(21, $permissions)) echo "checked"; @endphp />
                                        <span></span>{{ translate('Addon Manager') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary mr-2">{{translate('Update')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
