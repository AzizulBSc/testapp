@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
   @foreach($errors->all() as $error)
        <strong>{{"Error Occured!!"}}</strong> {{$error}}
   @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span class="fa fa-times"></span>
    </button>
</div>
@endif
