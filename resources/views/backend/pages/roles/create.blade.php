@extends('backend.layouts.master')
@section('title')
    All Role For this System
@endsection
@section('page-css')
@endsection
@section('content')
      <div class="main-content-inner">
          <!-- basic form start -->
          <div class="col-12 mt-5">
              <div class="card">
                  <div class="card-body">
                      <h4 class="header-title">Create Role</h4>
                      <form action="{{url('roles')}}" method="post">
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="form-group">
                              <label for="exampleInputName">Role Name</label>
                              <input type="text" name="name" class="form-control" id="exampleInputName" aria-describedby="roleHelp" placeholder="Enter New Role Name">
                              <small id="roleHelp" class="form-text text-muted">It is One kind of Position/Post of any office</small>
                          </div>
                          @include('backend.layouts.partials.error')
                          <div class="form-group">
                              <div class="form-check">
                                  <input type="checkbox" name="allpermission" value="" class="form-check-input" id="allpermission" aria-describedby="roleHelp" placeholder="Select Permission Name">
                                  <label for="allpermission">All</label>
                              </div>
                              <hr>
                              @foreach($group_name as $group)
                                  <div class="row">
                                  <div class="col-3">
                                      <div class="form-check">
                                          <input type="checkbox" name="group_name[]" value="{{$group->group_name}}" class="form-check-input {{$group->group_name}}input" id="{{$group->group_name}}" aria-describedby="roleHelp" onclick="checkPermissionByGroup(this)" placeholder="Select Permission Name">
                                          <label for="{{$group->group_name}}">{{ucfirst($group->group_name)}}</label>
                                      </div>
                                  </div>
                                      <div class="col-6 {{$group->group_name}}">
                                      @foreach($permissions as $permission)
                                          @if($permission->group_name==$group->group_name)
                                                  <div class="form-check">
                                                      <input type="checkbox" name="permissions[]" value="{{$permission->name}}" class="form-check-input {{$group->group_name}}input" id="{{$permission->name}}" aria-describedby="roleHelp" placeholder="Select Permission Name">
                                                      <label for="{{$permission->name}}">{{$permission->name}}</label>
                                                  </div>
                                          @endif
                                      @endforeach
                                          <hr>
                                      </div>
                                  </div>
                              @endforeach


                          </div>
                          <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Submit</button>
                      </form>
                  </div>
              </div>
          </div>
          <!-- basic form end -->
    </div>

@endsection
    @section('page-js')
        <script>
         $("#allpermission").click(function (){
             if($(this).is(':checked')){
                 $('input[type=checkbox]').prop('checked',true);
             }
             else{
                 $('input[type=checkbox]').prop('checked',false);
             }
         })

         function checkPermissionByGroup(this_check){
             var group_name = this_check.id;
             var checkboxes = document.getElementsByClassName(group_name + 'input');
             for (var i = 0; i < checkboxes.length; i++) {
                 checkboxes[i].checked = this_check.checked;
             }
         }

        </script>
    @endsection


