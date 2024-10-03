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
                                <div class="col-6" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.user.list') }}" class="btn btn-success text-right">Customer
                                        List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="@if (Route::currentRouteName() == 'admin.user.create') {{ route('admin.user.store') }} @else {{ route('admin.user.update', $user->id) }} @endif " method="POST" enctype="multipart/form-data" autocomplete="off">
                                @csrf
                                @if (Route::currentRouteName() != 'admin.user.create')
                                    @method('PUT')
                                @endif

                                <div class="login-form">
                                    <input type="hidden" name="type" value="{{ App\Helpers\Constant::USER_TYPE['customer'] }}">

                                    <div class="row">

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="name">Enter Customer Full Name<span class="text-danger">*</span></label>

                                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Full Name" value="@if ($user != ''){{  $user->name }}@else{{ old('name') }}@endif">

                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="email">Enter Customer Email<span class="text-danger">*</span></label>

                                                <input type="email" name="email"  id="email" class="form-control @error('email') is-invalid @enderror" placeholder="example@mail.com" value="@if ($user != ''){{  $user->email }}@else{{ old('email') }}@endif">

                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="phone">Enter Phone Number <span class="text-danger">*</span></label>
                                                <div class="w-100 d-inline-flex">
                                                    <div style="width: 70px;">
                                                        <input type="text" readonly class="text-center form-control" id="code" style="border-right: none !important; color: #000;" value="{{ old('tele_code') }}" placeholder="+11" name="tele_code">
                                                    </div>
                                                    <div style="width: 100%;">
                                                        <input type="text" name="phone"  id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="01XXXXXXXXX" value="@if ($user != ''){{  $user->phone }}@else{{ old('phone') }}@endif">
                                                        <i id="verify" class="fa fa-check phone_verify d-none"></i>
                                                        <div class="phoneError"></div>
                                                    </div>
                                                </div>

                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="gender">Select Gender <span class="text-danger">*</span></label>
                                                <select class="form-control select2 @error('gender') is-invalid @enderror" id="gender" name="gender">
                                                    <option value selected></option>
                                                    <option value="{{ App\Helpers\Constant::GENDER['male'] }}" @if ($user != '') @if ($user->gender == App\Helpers\Constant::GENDER['male']) selected @endif @else @if (old('gender') == App\Helpers\Constant::GENDER['male']) selected @endif @endif >Male</option>
                                                    <option value="{{ App\Helpers\Constant::GENDER['female'] }}" @if ($user != '') @if ($user->gender == App\Helpers\Constant::GENDER['female']) selected @endif @else @if (old('gender') == App\Helpers\Constant::GENDER['female']) selected @endif @endif >Female</option>
                                                    <option value="{{ App\Helpers\Constant::GENDER['others'] }}" @if ($user != '') @if ($user->gender == App\Helpers\Constant::GENDER['others']) selected @endif @else @if (old('gender') == App\Helpers\Constant::GENDER['others']) selected @endif @endif >Others</option>
                                                </select>

                                                @error('gender')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="country">Select User Country <span class="text-danger">*</span></label>
                                                <select class="form-control select2 @error('country') is-invalid @enderror" id="country" name="country">
                                                    <option value selected></option>
                                                    @foreach ($countries as $country)
                                                        <option value="{{ $country->id }}" @if ($user != '') @if ($country->id == $user->country) selected @endif  @else @if ($country->id == old('country')) selected @endif @endif >{{ $country->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('country')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="d-none">
                                            <input type="text" value="1" name="states" id="states">
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="division">Select Division <span class="text-danger">*</span></label>
                                                <select class="form-control select2 @error('division_id') is-invalid @enderror" id="division" name="division_id">
                                                    <option value selected></option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}" @if ($division->id == old('division_id')) selected @endif >{{ $division->name }}</option>
                                                    @endforeach
                                                </select>

                                                @error('division_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="division">Select District <span class="text-danger">*</span></label>
                                                <select class="form-control select2 @error('district_id') is-invalid @enderror" id="district" name="district_id">
                                                    <option value selected></option>
                                                </select>

                                                @error('district_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="upazila">Select Upazila <span class="text-danger"></span></label>
                                                <select class="form-control select2 @error('upazila_id') is-invalid @enderror" id="upazila" name="upazila_id">
                                                    <option value selected></option>
                                                </select>

                                                @error('upazila_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                            <div class="form-group">
                                                <label for="union">Select Union / Pourashava <span class="text-danger"></span></label>
                                                <select class="form-control select2 @error('union_id') is-invalid @enderror" id="union" name="union_id">
                                                    <option value selected></option>
                                                </select>

                                                @error('union_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="password">Enter Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimum 8 Character" value="@if ($user != ''){{  $user->show_password }}@else{{ old('password') }}@endif">
                                        <span class="password-show-btn" id="password-show"><i id="password-show-icon" class="fa fa-eye"></i></span>

                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="con_password">Enter Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" id="con_password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Minimum 8 Character" value="@if ($user != ''){{  $user->show_password }}@else{{ old('password_confirmation') }}@endif">
                                        <span class="password-show-btn" id="con-password-show"><i id="con-password-show-icon" class="fa fa-eye"></i></span>

                                        <div class="con_passwordError"></div>

                                        @error('password_confirmation')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="status">User Status <span class="text-danger">*</span></label>
                                                <select name="status" class="form-control select2 @error('status') is-invalid @enderror" id="status">
                                                    <option value="{{ App\Helpers\Constant::USER_STATUS['active'] }}" @if ($user != ''){{ ($user->status == App\Helpers\Constant::USER_STATUS['active']) ? 'selected' : ''  }}@endif>Approved</option>

                                                    <option value="{{ App\Helpers\Constant::USER_STATUS['deactive'] }}" @if ($user != ''){{ ($user->status == App\Helpers\Constant::USER_STATUS['deactive']) ? 'selected' : ''  }}@endif>Non-Approved</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    @if ($user != '')
                                        <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                                    @endif

                                    <div class="form-group mt-3">
                                        <button type="submit" class="btn btn-success form-control" style="font-weight: 600;">
                                        @if (Route::currentRouteName() == 'admin.user.create')
                                            Add
                                        @else
                                            Update
                                        @endif
                                            Customer
                                        </button>
                                    </div>

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


@push('js')
    @include('layouts.admin.all-select2')
    <script>

        $(document).ready(function () {
            @if ($user != '')
                setTimeout(() => {
                    $('#country').val({{ $user->country }}).trigger('change');
                    $('#division').val({{ $user->division_id }}).trigger('change');

                    setTimeout(() => {
                        $('#district').val({{ $user->district_id }}).trigger('change');
                    }, 1000);

                    setTimeout(() => {
                        $('#upazila').val({{ $user->upazila_id }}).trigger('change');
                    }, 1500);

                    setTimeout(() => {
                        $('#union').val({{ $user->union_id }}).trigger('change');
                    }, 2000);

                    setTimeout(() => {
                        $('#village').val({{ $user->village_id }}).trigger('change');
                    }, 2500);
                }, 500);
            @endif
        });

        $( function() {
            $("#birthday").datepicker({
                dateFormat: 'dd-mm-yy',
                showButtonPanel: true,
                changeMonth: true,
                changeYear: true,
                showOtherMonths: true,
                selectOtherMonths: true,
                yearRange: '1950:{{ date("Y") }}'
            });

            country();
            division();
            district();
            upazila();
            village();
        } );
    </script>

    <script>

        $("#password-show").on("click", function() {
            var passwordField = $("#password");
            var passwordIcon = $("#password-show-icon");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
            else {
                passwordField.attr("type", "password");
                passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $("#con-password-show").on("click", function() {
            var passwordField = $("#con_password");
            var passwordIcon = $("#con-password-show-icon");

            if (passwordField.attr("type") === "password") {
                passwordField.attr("type", "text");
                passwordIcon.removeClass("fa-eye").addClass("fa-eye-slash");
            }
            else {
                passwordField.attr("type", "password");
                passwordIcon.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });

        $('#phone').keyup(function(){
            let username =$(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(username != ''){
                if (regex.test(username)) {
                    url = "{{ route('ajax.username.check', ':username') }}";
                    url = url.replace(':username', username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Phone Number is available </span>';
                                $('#phone').removeClass('is-invalid');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">The Phone Number has already been taken.</span>';
                                $('#phone').addClass('is-invalid');
                            }
                            $('.phoneError').html(html);
                        }
                    });

                }
                else {
                    $('.phoneError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Phone Number. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });


        $('#refer').keyup(function(){
            let refer_username = $(this).val();

            var regex = /^[a-zA-Z0-9]+$/;

            if(refer_username != ''){
                if (regex.test(refer_username)) {
                    url = "{{ route('ajax.referusername.check', ':refer_username') }}";
                    url = url.replace(':refer_username', refer_username);

                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            let html = '';
                            if(data === 'no'){
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username </span>';
                                $('#refer').addClass('is-invalid');
                                $('.refer_verify').addClass('d-none');
                            }
                            else{
                                html = '<span style="font-size: 16px; font-weight: 500;" class="text-success">Refer User : '+ data +' </span>';
                                $('#refer').removeClass('is-invalid');
                                $('.refer_verify').removeClass('d-none');
                            }
                            $('.referError').html(html);
                        }
                    });

                }
                else {
                    $('.referError').html('<span style="font-size: 16px; font-weight: 500;" class="text-danger">Invalid Refer Username. Spaces, dots, and special characters are not allowed.</span>');
                }
            }
        });


        $(document).ready(function(){
            $('#password, #con_password').on('keyup', function () {
                if ($('#password').val() === $('#con_password').val()) {
                    $('.con_passwordError').html('Passwords Matched.').css('color', 'green');
                    $('#con_password').removeClass('is-invalid');
                }
                else{
                    $('.con_passwordError').html('Passwords do not match').css('color', 'red');
                    $('#con_password').addClass('is-invalid');
                }
            });
        });

    </script>
    {{-- user own image script --}}
    <script>
        $(document).ready(function() {
            $(".picture__input").each(function(index) {
                const pictureImage = $(this).prev().find(".picture__image");
                const pictureImageTxt = ``;

                $(this).on("change", function(e) {
                    const file = e.target.files[0];

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const img = $("<img>").attr("src", e.target.result).addClass("picture__img");
                            pictureImage.empty().append(img);
                        };
                        reader.readAsDataURL(file);
                    } else {
                        // pictureImage.html(pictureImageTxt);
                    }
                });
            });
        });
    </script>
    <script>
        function remove(field_name, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this Image?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {

                if (result.isConfirmed) {
                    let user_id = $('#user_id').val();
                    console.log(user_id);
                    var url = '{{ route('admin.user.image.remove', [':param1', ':param2', ':param3']) }}';
                    url = url.replace(':param1', field_name);
                    url = url.replace(':param2', class_name);
                    url = url.replace(':param3', user_id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+data).html('');
                        }
                    });

                }
            });
        }

    </script>
@endpush
