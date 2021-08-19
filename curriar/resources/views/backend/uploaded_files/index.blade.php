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
                    <h5 class="text-dark font-weight-bold my-1 mr-5">{{ translate('Media Manager') }}</h5>
                    <!--end::Page Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm mr-5">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard')}}" class="text-muted">{{translate('Dashboard')}}</a>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="#" class="text-muted">{{ translate('Media Manager') }}</a>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
					<!--begin::Actions-->
					<a href="{{ route('uploaded-files.create') }}" class="btn btn-light-primary font-weight-bolder btn-sm"><i class="flaticon-upload"></i> {{translate('Upload New File')}}</a>
					<!--end::Actions-->
                </div>
                <!--end::Page Heading-->
            </div>
        </div>
    </div>
    <!--end::Subheader-->
@endsection
    
@section('content')
	<div class="row">
		<div class="col-lg-12">
			<div class="card card-custom">

				<div class="card-header">
					<div class="card-title">
						<span class="card-icon">
							<i class="flaticon2-files-and-folders"></i>
						</span>
						<h3 class="card-label">{{translate('All uploaded files')}}</h3>
					</div>
					<div class="card-toolbar">
						<form id="sort_uploads" action="" class="form">
							<div class="form-group row mb-0">
								<div class="col-lg-4">
									<select class="form-control form-control-xs aiz-selectpicker" name="sort" onchange="sort_uploads()">
										<option value="newest" @if($sort_by == 'newest') selected="" @endif>{{ translate('Sort by newest') }}</option>
										<option value="oldest" @if($sort_by == 'oldest') selected="" @endif>{{ translate('Sort by oldest') }}</option>
										<option value="smallest" @if($sort_by == 'smallest') selected="" @endif>{{ translate('Sort by smallest') }}</option>
										<option value="largest" @if($sort_by == 'largest') selected="" @endif>{{ translate('Sort by largest') }}</option>
									</select>
								</div>
								<div class="col-lg-6">
									<input type="text" class="form-control form-control-xs" name="search" placeholder="{{ translate('Search your files') }}" value="{{ $search }}">
								</div>
								<div class="col-lg-2">
									<button type="submit" class="btn btn-primary">{{ translate('Search') }}</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="card-body">
					<div class="row gutters-5">
						@foreach($all_uploads as $key => $file)
							@php
								if($file->file_original_name == null){
									$file_name = translate('Unknown');
								}else{
									$file_name = $file->file_original_name;
								}
							@endphp
							<div class="col-auto w-150px w-lg-220px">
								<div class="aiz-file-box">
									<div class="dropdown-file" >
										<a class="dropdown-link" data-toggle="dropdown">
											<i class="la la-ellipsis-v"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a href="javascript:void(0)" class="dropdown-item" onclick="detailsInfo(this)" data-id="{{ $file->id }}">
												<i class="las la-info-circle mr-2"></i>
												<span>{{ translate('Details Info') }}</span>
											</a>
											<a href="{{ my_asset($file->file_name) }}" target="_blank" download="{{ $file_name }}.{{ $file->extension }}" class="dropdown-item">
												<i class="la la-download mr-2"></i>
												<span>{{ translate('Download') }}</span>
											</a>
											<a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)" data-url="{{ my_asset($file->file_name) }}">
												<i class="las la-clipboard mr-2"></i>
												<span>{{ translate('Copy Link') }}</span>
											</a>
											<a href="javascript:void(0)" class="dropdown-item confirm-alert" data-href="{{ route('uploaded-files.destroy', $file->id ) }}" data-target="#delete-modal">
												<i class="las la-trash mr-2"></i>
												<span>{{ translate('Delete') }}</span>
											</a>
										</div>
									</div>
									<div class="card card-file aiz-uploader-select c-default" title="{{ $file_name }}.{{ $file->extension }}">
										<div class="card-file-thumb">
											@if($file->type == 'image')
												<img src="{{ my_asset($file->file_name) }}" class="img-fit">
											@elseif($file->type == 'video')
												<i class="las la-file-video"></i>
											@else
												<i class="las la-file"></i>
											@endif
										</div>
										<div class="card-body">
											<h6 class="d-flex">
												<span class="text-truncate title">{{ $file_name }}</span>
												<span class="ext">.{{ $file->extension }}</span>
											</h6>
											<p>{{ formatBytes($file->file_size) }}</p>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
					<div class="aiz-pagination mt-3">
						{{ $all_uploads->appends(request()->input())->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection


@section('modal')
<div id="delete-modal" class="modal fade">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mt-1">{{ translate('Are you sure to delete this file?') }}</p>
                <button type="button" class="btn btn-link mt-2" data-dismiss="modal">{{ translate('Cancel') }}</button>
                <a href="" class="btn btn-primary mt-2 comfirm-link">{{ translate('Delete') }}</a>
            </div>
        </div>
    </div>
</div>
<div id="info-modal" class="modal fade">
	<div class="modal-dialog modal-dialog-right">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title h6">{{ translate('File Info') }}</h5>
				<button type="button" class="close" data-dismiss="modal">
				</button>
			</div>
			<div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
				<div class="c-preloader text-center absolute-center">
                    <i class="las la-spinner la-spin la-3x opacity-70"></i>
                </div>
			</div>
		</div>
	</div>
</div>

@endsection
@section('script')
	<script type="text/javascript">
		function detailsInfo(e){
            $('#info-modal-content').html('<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>');
			var id = $(e).data('id')
			$('#info-modal').modal('show');
			$.post('{{ route('uploaded-files.info') }}', {_token: AIZ.data.csrf, id:id}, function(data){
                $('#info-modal-content').html(data);
				// console.log(data);
			});
		}
		function copyUrl(e) {
			var url = $(e).data('url');
			var $temp = $("<input>");
		    $("body").append($temp);
		    $temp.val(url).select();
		    try {
			    document.execCommand("copy");
			    AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
			} catch (err) {
			    AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
			}
		    $temp.remove();
		}
        function sort_uploads(el){
            $('#sort_uploads').submit();
        }
	</script>
@endsection