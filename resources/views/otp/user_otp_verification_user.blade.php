

@extends('layouts.customer.app')
@section('content')
<style>
    .file {
        width: 150px;
        height: 150px;
        border: 1px solid #ddd;
        padding: 2px;
        border-radius: 0px;
        margin-right: 15px;
    }
</style>
    <div class="row m-auto">
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-header card-title align-middle">
                    <div class="d-flex">
                        <div class="w-100 align-middle">
                            <h5 class="">{{ $pageTitle }}</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                                <form action="{{ route('user.customer.client.otp.store') }}" method="POST">
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
                </div>
            </div>
        </div>
    </div>

@endsection

