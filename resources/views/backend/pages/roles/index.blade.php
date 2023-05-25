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
    <div class="main-content-inner">
        <div class="row">
            <!-- data table start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Data Table Default</h4>
                        <div class="data-tables datatable-dark">
                            <table id="" class="text-center table-striped">
                                <thead class="bg-dark text-capitalize">
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th width="10%">Name</th>
{{--                                    <th width="60%">Permissions</th>--}}
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$role->name}}</td>
{{--                                        <td><span class="badge badge-pill badge-primary">Primary</span></td>--}}
                                        <td>
                                            <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
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


