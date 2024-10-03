@extends('layouts.admin.app')
@section('content')
    <style>
        .login-form div.form-group .password-show-btn{
            position: absolute;
            right: 30px;
            margin-top: -29px;
            font-size: 18px;
            cursor: pointer;
            color: #333;
            transition: 0.3s;
        }

        #verify{
            position: absolute;
            right: 30px;
            margin-top: -29px;
            font-size: 16px;
            cursor: pointer;
            color: #40bb7d;
            transition: 0.3s;
        }

        .login-form div.form-group #password-show:hover, .login-form div.form-group #con-password-show:hover {
            color: #20774b;
        }

        .picture__input {
            display: none;
        }

        .picture {
            width: 120px;
            height: 120px;
            aspect-ratio: 16/9;
            background: #28a74517;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
            border: 2px dashed #28a7459c;
            cursor: pointer;
            font-family: sans-serif;
            transition: color 300ms ease-in-out, background 300ms ease-in-out;
            outline: none;
            overflow: hidden;
            font-size: 12px;
            text-align: center;
        }

        .picture:hover {
            color: #777;
            background: #ccc;
        }

        .picture:active {
            border-color: turquoise;
            color: turquoise;
            background: #eee;
        }

        .picture:focus {
            color: #777;
            background: #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .picture__img {
            max-width: 100%;
        }


    </style>
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
                                <div class="col-12" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 border m-auto px-3">
                                    <div class="form-group p-3 pb-0 mb-0 text-center">
                                        <img src="{{ asset('uploads/system/').'/'.companyInfo()->website_logo }}" class="" width="100" alt="logo.png" style="width: 100px; height: 100px; border-radius: 50%; border: 1px solid #ddd;">
                                    </div>
                                    <div class="form-group text-center">
                                        <h4 class="text-bold">{{ $pageTitle }}</h4>
                                    </div>
                                    @error('otp')
                                        <div class="form-group text-center">
                                            <div class="alert alert-danger" style="color: #fff; background-color: #ff19300f; border-color: #d32535;">
                                                <span class="text-danger">{{ $message }}</span>
                                            </div>
                                        </div>
                                    @enderror
                                    <form action="{{ route('admin.user.otp.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" value="{{ $user->id }}" name="id">
                                        <div class="form-group">
                                            <label for="email">Email <span class="text-danger">*</span></label>
                                            <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}" placeholder="example@mail.com" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="otp">OTP <span class="text-danger">*</span></label>
                                            <input type="number" required id="otp" name="otp" class="form-control @error('otp') is-invalid @enderror" placeholder="Enter OTP" >
                                        </div>
                                        <div class="form-group pb-4 pt-2">
                                            <button type="submit" class="btn btn-success form-control">Verify</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

