@extends('backend.layouts.master')
@section('title')
    user Edit-Admin Panel
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
      <div class="main-content-inner">
          <!-- basic form start -->
          <div class="col-12 mt-5">
              <div class="card">
                  <div class="card-body">
                      <h4 class="header-title">Edit user</h4>
                      @include('backend.layouts.partials.message')

                      <form action="{{ route('users.update', $user->id) }}" method="POST">
                          @method('PUT')
                          @csrf
                          <div class="form-row">
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="name">User Name</label>
                                  <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="{{ $user->name }}">
                              </div>
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="email">User Email</label>
                                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $user->email }}">
                              </div>
                          </div>

                          <div class="form-row">
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                              </div>
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="password_confirmation">Confirm Password</label>
                                  <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Enter Password">
                              </div>
                          </div>

                          <div class="form-row">
                              <div class="form-group col-md-6 col-sm-12">
                                  <label for="password">Assign Roles</label>
                                  <select name="roles[]" id="roles" class="form-control select2" multiple>
                                      @foreach ($roles as $role)
                                          <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>

                          <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save User</button>
                      </form>
                  </div>
              </div>
          </div>
          <!-- basic form end -->
    </div>

@endsection
    @section('page-js')
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.select2').select2();
            })
        </script>
    @endsection


