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
                            <h3 class="card-title">Withdraw Config</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.deposit_withdrawal.withdrawal_config_store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="min_withdraw">Min Withdraw <span class="text-danger">*</span> <br> ( if no min limit then must be use 0.00 )</label>
                                            <input type="number" name="min_withdraw" id="min_withdraw" class="form-control @error('min_withdraw') is-invalid @enderror" value="{{ $company_info->min_withdraw }}" required placeholder="Enter Min Withdraw Amount">
                                            @error('min_withdraw')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="max_withdraw">Max Withdraw <span class="text-danger">*</span> <br> ( if no max limit then must be use blank )</label>
                                            <input type="number" name="max_withdraw" id="max_withdraw" class="form-control @error('max_withdraw') is-invalid @enderror" value="{{ $company_info->max_withdraw }}" placeholder="Enter Mix Withdraw Amount">
                                            @error('max_withdraw')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group pt-3 text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-6 d-none">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Deposit Config</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.deposit_withdrawal.deposit_config_store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="min_deposit">Min Deposit <span class="text-danger">*</span> <br> ( if no min limit then must be use 0.00 )</label>
                                            <input type="number" name="min_deposit" value="{{ $company_info->min_deposit }}"  id="min_deposit" class="form-control @error('min_deposit') is-invalid @enderror" placeholder="Enter Min Deposit Amount">
                                            @error('min_deposit')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="max_deposit">Max Deposit <span class="text-danger">*</span> <br> ( if no max limit then must be use blank )</label>
                                            <input type="number" name="max_deposit" value="{{ $company_info->max_deposit }}" id="max_deposit" class="form-control @error('max_deposit') is-invalid @enderror" placeholder="Enter Mix Deposit Amount">
                                            @error('max_deposit')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group pt-3 text-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
