@extends('backend.layouts.app')

@section('content')
<div class="col-lg-12 mx-auto">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0 h6">{{translate('Covered Cities')}} ({{$country->name}})</h5>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="{{ route('admin.shipments.post_covered_cities',['country_id'=>$country->id]) }}" id="kt_form_1" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
            <div class="col-md-3">
                <input type="checkbox"  id="checkAll" /> <b>{{translate('Select All')}}</b>
            </div>
            </div>
            <div class="row">
                @foreach($cities as $city)
                <div class="col-md-3">
                <input type="checkbox" name="covered_cities[]" id="" value="{{$city->id}}" @if($city->covered == 1) checked @endif /> {{$city->name}}
              
                </div>
                @endforeach
            </div>
            </from>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-5"></div>
                <div class="col-lg-7">
                    <button type="submit" class="btn btn-lg btn-primary">{{translate('Save')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
</script>
@endsection