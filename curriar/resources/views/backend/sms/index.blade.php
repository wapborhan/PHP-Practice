@extends('backend.layouts.app')

@section('content')

    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{translate('SMS')}}</h1>
            </div>
            <div class="col-md-6 text-md-right">
            </div>
        </div>
    </div>

    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Send Newsletter')}}</h5>
            </div>
        <form class="form-horizontal" action="{{ route('sms.send') }}" method="POST" enctype="multipart/form-data">
        	@csrf
            <div class="card-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('Mobile')}} ({{__('Users')}})</label>
                    <div class="col-sm-10">
                        <select class="form-control demo-select2-multiple-selects" name="user_phones[]" multiple>
                            @foreach($users as $user)
                                @if ($user->phone != null)
                                    <option value="{{$user->phone}}">{{$user->phone}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="subject">{{__('SMS subject')}}</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="subject" id="subject" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">{{__('SMS content')}}</label>
                    <div class="col-sm-10">
                        <textarea class="resize-off form-control" name="msg" required></textarea>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-sm btn-primary" type="submit">{{__('Send')}}</button>
            </div>
        </form>
        <!--===================================================-->
        <!--End Horizontal Form-->

    </div>
</div>

@endsection
