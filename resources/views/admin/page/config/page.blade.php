@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Company Info</h1>
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
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Home Page Banner</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.home.banner.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Home Page Banner <span class="text-danger"> *</span> <span>( Image Size: 1904 * 563 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Home Page Banner URL">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($home_banner as $banner)
                                            @if ($banner->type == App\Helpers\Constant::BANNER_TYPE['home'])
                                                <div style="margin-right: 10px;" class="banner_img_{{ $banner->id }}">
                                                    <div class="uploaded-img">
                                                        <img src="{{ asset('uploads/banner').'/'.$banner->img }}" alt="">
                                                        <span class="img-remove" onclick="remove('{{ $banner->type }}', 'banner_img_{{ $banner->id }}', '{{ $banner->id }}');">x</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Ads Banner One</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.home.banner.one.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Ads Banner <span class="text-danger"> *</span> <span>( Image Size: 414 * 215 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Ads Banner URL">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($home_banner as $banner)
                                            @if ($banner->type == App\Helpers\Constant::BANNER_TYPE['ads_banner_1'])
                                                <div style="margin-right: 10px;" class="banneroneimg{{ $banner->id }}">
                                                    <div class="uploaded-img">
                                                        <img src="{{ asset('uploads/banner').'/'.$banner->img }}" alt="">
                                                        <span class="img-remove" onclick="remove('{{ $banner->type }}', 'banneroneimg{{ $banner->id }}', '{{ $banner->id }}');">x</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Ads Banner Two</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.home.banner.two.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Ads Banner <span class="text-danger"> *</span> <span>( Image Size: 1278 * 265 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Ads Banner URL">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($home_banner as $banner)
                                            @if ($banner->type == App\Helpers\Constant::BANNER_TYPE['ads_banner_2'])
                                                <div style="margin-right: 10px;" class="bannertwoimg{{ $banner->id }}">
                                                    <div class="uploaded-img">
                                                        <img src="{{ asset('uploads/banner').'/'.$banner->img }}" alt="">
                                                        <span class="img-remove" onclick="remove('{{ $banner->type }}', 'bannertwoimg{{ $banner->id }}', '{{ $banner->id }}');">x</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Ads Banner Three</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.home.banner.three.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Ads Banner <span class="text-danger"> *</span> <span>( Image Size: 303 * 828 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Ads Banner URL">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($home_banner as $banner)
                                            @if ($banner->type == App\Helpers\Constant::BANNER_TYPE['ads_banner_3'])
                                                <div style="margin-right: 10px;" class="bannerthreeimg{{ $banner->id }}">
                                                    <div class="uploaded-img">
                                                        <img src="{{ asset('uploads/banner').'/'.$banner->img }}" alt="">
                                                        <span class="img-remove" onclick="remove('{{ $banner->type }}', 'bannerthreeimg{{ $banner->id }}', '{{ $banner->id }}');">x</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Ads Banner Four</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.home.banner.four.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Ads Banner <span class="text-danger"> *</span> <span>( Image Size: 626 * 216 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Ads Banner URL">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($home_banner as $banner)
                                            @if ($banner->type == App\Helpers\Constant::BANNER_TYPE['ads_banner_4'])
                                                <div style="margin-right: 10px;" class="bannerfourimg{{ $banner->id }}">
                                                    <div class="uploaded-img">
                                                        <img src="{{ asset('uploads/banner').'/'.$banner->img }}" alt="">
                                                        <span class="img-remove" onclick="remove('{{ $banner->type }}', 'bannerfourimg{{ $banner->id }}', '{{ $banner->id }}');">x</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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

                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Ads Banner Five</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.home.banner.five.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="img">Ads Banner <span class="text-danger"> *</span> <span>( Image Size: 1278 * 230 px )</span></label>
                                            <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img">
                                            @error('img')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="url">URL</label>
                                            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url" name="url" placeholder="Enter Ads Banner URL">
                                            @error('url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        @foreach ($home_banner as $banner)
                                            @if ($banner->type == App\Helpers\Constant::BANNER_TYPE['ads_banner_5'])
                                                <div style="margin-right: 10px;" class="bannerfiveimg{{ $banner->id }}">
                                                    <div class="uploaded-img">
                                                        <img src="{{ asset('uploads/banner').'/'.$banner->img }}" alt="">
                                                        <span class="img-remove" onclick="remove('{{ $banner->type }}', 'bannerfiveimg{{ $banner->id }}', '{{ $banner->id }}');">x</span>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-bottom bg-secondary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">Socials Icon Settings</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.social.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-0">
                                    <label for="facebook">Facebook</label>
                                    <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror" placeholder="Enter Facebook Link" value="{{ socials()->facebook }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="instagram">Instagram</label>
                                    <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror" placeholder="Enter Instagram Link" value="{{ socials()->instagram }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="text" name="linkedin" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" placeholder="Enter Linkedin Link" value="{{ socials()->linkedin }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="x">X (Twitter)</label>
                                    <input type="text" name="x" id="x" class="form-control @error('x') is-invalid @enderror" placeholder="Enter X Link" value="{{ socials()->x }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email Address" value="{{ socials()->email }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="phone">Phone</label>
                                    <input type="number" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Phone Number" value="{{ socials()->phone }}">
                                </div>
                                <div class="form-group mt-4 text-right">
                                    <button type="submit" class="text-right btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header border-bottom bg-secondary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">Contact Info</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.genarelSetting.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-0">
                                    <label for="address1">Address Line One</label>
                                    <input type="text" name="address1" id="address1" class="form-control @error('address') is-invalid @enderror" value="{{ explode('<br>', ganarelsetting()->address)[0] ?? '' }}">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group mt-3">
                                    <label for="address2">Address Line Two</label>
                                    <input type="text" name="address2" id="address2" class="form-control @error('address') is-invalid @enderror" value="{{ explode('<br>', ganarelsetting()->address)[1] ?? '' }}">

                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="phone">Phone Number (Use ' , ' If you want to use multipe phone number )</label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ ganarelsetting()->phone }}">

                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="email">Email Address (Use ' , ' If you want to use multipe email address )</label>
                                    <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ ganarelsetting()->email }}">

                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="map">Google Map Embaded (Only URL)</label>
                                    <input type="text" name="map" id="map" class="form-control @error('map') is-invalid @enderror" value="{{ ganarelsetting()->map }}">

                                    @error('map')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <label for="about_company">About Company</label>
                                    <textarea name="about_company" id="about_company" row="6" class="form-control @error('about_company') is-invalid @enderror">{{ ganarelsetting()->about_company }}</textarea>

                                    @error('about_company')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group mt-4 text-right">
                                    <button type="submit" class="text-right btn btn-success">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('js')
    <script>
        function remove(type, class_name, id){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this page banner?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('admin.settings.home.banner.remove', [':id', ':class_name']) }}';
                    url = url.replace(':id', id);
                    url = url.replace(':class_name', class_name);
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
