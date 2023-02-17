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
                          <div class="form-group">
                              <label for="exampleInputPermission">All Permissions</label>
                              @foreach($permissions as $permission)
                                  <div class="form-check">
                                      <input type="checkbox" name="permissions[]" value="{{$permission->name}}" class="form-check-input" id="{{$permission->name}}" aria-describedby="roleHelp" placeholder="Select Permission Name">
                                      <label for="{{$permission->name}}">{{$permission->name}}</label>
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


        </script>
    @endsection


