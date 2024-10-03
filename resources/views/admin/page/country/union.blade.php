@extends('layouts.admin.app')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $pageTitle }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">

                            <div class="row">
                                <div class="col-6" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" id="addCountryModalBtn"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table width='100%' class="table table-sm text-center" id="datatable">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Name</th>
                                        <th>BN Name</th>
                                        <th>URL</th>
                                        <th>Upzila</th>
                                        <th>District</th>
                                        <th>Division</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('admin.modals.add-union')
@endsection

@push('js')
    <script>
        var datatable;
        $(document).ready(function(){
            datatable= $('#datatable').DataTable({
                processing:true,
                serverSide:true,
                responsive:true,
                ajax:{
                    url:"{{ url()->current() }}"
                },
                columns:[
                    {
                        data:'DT_RowIndex',
                        name:'DT_RowIndex',
                        orderable:false,
                        searchable:false
                    },
                    {
                        data:'name',
                        name:'name',
                    },
                    {
                        data:'bn_name',
                        name:'bn_name',
                    },
                    {
                        data:'url',
                        name:'url',
                    },
                    {
                        data:'upzila',
                        name:'upzila',
                    },
                    {
                        data:'district',
                        name:'district',
                    },
                    {
                        data:'division',
                        name:'division',
                    },
                    {
                        data:'action',
                        name:'action',
                        className: 'text-center'
                    }
                ]
            });
        })

    </script>
@endpush

