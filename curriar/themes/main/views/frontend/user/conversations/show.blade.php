@extends('frontend.layouts.app')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex align-items-start">
                @include('frontend.inc.user_side_nav')

                <div class="aiz-user-panel">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">#{{ $conversation->title }}
                            (
                                {{ translate('Between you and') }}
                                @if ($conversation->sender_id == Auth::user()->id)
                                    {{ $conversation->receiver->name }}
                                @else
                                    {{ $conversation->sender->name }}
                                @endif
                            )
                            </h5>
                            <br>
                            @if ($conversation->sender_id == Auth::user()->id && $conversation->receiver->shop != null)
                                <a href="{{ route('shop.visit', $conversation->receiver->shop->slug) }}">{{ $conversation->receiver->shop->name }}</a>
                            @endif
                        </div>

                        <div class="card-body">
                            @foreach($conversation->messages as $message)
                                {{-- @if ($message->user_id == Auth::user()->id)
                                @endif --}}
                                <div class="media mb-2">
                                  <img class="avatar avatar-sm m-3" @if($message->user != null) src="{{ uploaded_asset($message->user->avatar_original) }}" @endif alt="{{ translate('Image') }}">
                                  <div class="media-body">
                                    <h6 class="mt-0">
                                        @if ($message->user != null)
                                            {{ $message->user->name }}
                                        @endif
                                    </h6>
                                    <p class="text-muted">{{$message->created_at}}</p>
                                    <p>
                                        {{ $message->message }}
                                    </p>
                                  </div>
                                </div>
                            @endforeach
                            <form class="mt-4" action="{{ route('messages.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="4" name="message" placeholder="{{ translate('Type your reply') }}" required></textarea>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-right">
                                    <button type="submit" class="btn btn-primary">{{ translate('Send') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script type="text/javascript">
    function refresh_messages(){
        $.post('{{ route('conversations.refresh') }}', {_token:'{{ @csrf_token() }}', id:'{{ encrypt($conversation->id) }}'}, function(data){
            $('#messages').html(data);
        })
    }

    refresh_messages(); // This will run on page load
    setInterval(function(){
        refresh_messages() // this will run after every 5 seconds
    }, 4000);
    </script>
@endsection
