@extends('backend.layouts.master')
@section('title')
Chat With User - Admin Panel
@endsection
@section('page-css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .form-check-label {
        text-transform: capitalize;
    }
</style>
@endsection

@section('content')
<!-- page title area start -->
<div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">Chat Your Firend</h4>
                <ul class="breadcrumbs pull-left">
                    {{-- <li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>--}}
                    {{-- <li><a href="{{ route('admin.users.index') }}">All Users</a></li>--}}
                    <li><span>Chat Your Firend</span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 clearfix">
            {{-- @include('backend.layouts.partials.logout')--}}
        </div>
    </div>
</div>
<!-- page title area end -->

<div class="main-content-inner">
    <div class="row">
        <!-- data table start -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body" id="message-area">
                    @foreach ($history as $data )
                    @if ($data->sender_id == auth()->user()->id)
                    <div class="form-row justify-content-left">
                        <div class="form-group col-md-8 col-sm-8">{{ $data->message }}
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                            <p class="font-weight-bold">{{ $data->username }}</p>
                        </div>
                    </div>
                    @else
                    <div class="form-row">
                        <div class="form-group col-md-4 col-sm-4">
                            <p class="font-weight-bold">{{ $data->username }}</p>
                        </div>
                        <div class="form-group col-md-4 col-sm-4">
                           {{ $data->message }}
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="card-body">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <input type="text" class="form-control rounded-pill" id="message" name="message"
                                placeholder="Enter messeage">
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <button type="submit" class="btn btn-primary rounded-pill" id="send">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->

    </div>
</div>
@endsection

@section('page-js')
<script>
    $(document).ready(function() {
            $('.select2').select2();
        })
  var message = document.getElementById('message');
  var sendbtn = document.getElementById('send');
  var user_id = @json((string) auth()->user()->id);
    sendbtn.addEventListener('click', function() {
    sendMessage();
  });

  message.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
  sendMessage();
  }
  });

  function sendMessage() {
    var messageInput = document.getElementById('message');
    if(messageInput.value == '') {
      return false;
    }
   let data = {username:"{{ auth()->user()->name }}",message:messageInput.value};
   $.ajax({
      url:"{{ route('message') }}",
      type:'POST',
      data:data,
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
success: function(response) {
// Handle the success response here
},
error: function(error) {
// Handle the error response here
}
});
Echo.channel('message').stopListening('MessageEvent');
Echo.channel('message').listen('MessageEvent',(e)=>{
    var message = '';
   if(e.sender_id == user_id) {
   message = `<div class="form-row justify-content-left">
        <div class="form-group col-md-8 col-sm-8">${e.message}
        </div>
        <div class="form-group col-md-4 col-sm-4"><p class="font-weight-bold">${e.username}</p>
        </div>
    </div>`;
}
else { 
message = `<div class="form-row">
    <div class="form-group col-md-4 col-sm-4"><p class="font-weight-bold">${e.username}</p>
    </div>
    <div class="form-group col-md-8 col-sm-8">${e.message}
    </div>
</div>`;
}
    $("#message-area").append(message);
    })
messageInput.value = '';
  }

</script>
@endsection