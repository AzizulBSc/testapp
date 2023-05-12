@extends('backend.layouts.master')
@section('title')
    All Role For this System
@endsection
@section('page-css')
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">

@endsection
@section('content')
    <!-- page title area start -->
    <div class="page-title-area">
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="breadcrumbs-area clearfix">
                    <h4 class="page-title pull-left">Dashboard</h4>
                    <ul class="breadcrumbs pull-left">
                        <li><a href="index.html">Home</a></li>
                        <li><span>Dashboard</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="user-profile pull-right">
                    <img class="avatar user-thumb" src="{{asset('backend/assets/images/author/avatar.png')}}" alt="avatar">*/
                    <h4 class="user-name dropdown-toggle" data-toggle="dropdown">Kumkum Rai <i class="fa fa-angle-down"></i></h4>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Message</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <a class="dropdown-item" href="#">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Data Table Default</h4>
                        <div class="">
                            <table id="dataTable" class="text-center">
                                <thead class="bg-light text-capitalize">
                                <tr>
{{--                                    <th>SN</th>--}}
                                    <th>Position</th>
{{--                                    <th>Gurd</th>--}}
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
{{--                                        <td>{{$loop->index+1}}</td>--}}
                                        <td>{{$role->name}}</td>
{{--                                        <td>{{$role->guard_name}}</td>--}}
                                        <td>
                                            <a class="btn btn-danger" href="">Delete</a>
                                            <a class="btn btn-warning" href="{{ url('/roles/'.$role->id . '/edit')}}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- data table end -->
        </div>
    </div>

@endsection
    @section('page-js')

        <!-- Start datatable js -->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
        <!-- others plugins -->
        <script>

            /*================================
            datatable active
            ==================================*/
            if ($('#dataTable').length) {
                $('#dataTable').DataTable({
                    responsive: true
                });
            }
            if ($('#dataTable2').length) {
                $('#dataTable2').DataTable({
                    responsive: true
                });
            }
            if ($('#dataTable3').length) {
                $('#dataTable3').DataTable({
                    responsive: true
                });
            }

        </script>
    @endsection


