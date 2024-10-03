@extends('layouts.admin.app')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <!-- Responsive Table -->
    <div class="card">
        <div class="card-header border-bottom bg-primary d-flex py-3">
            <h5 class="card-title mb-0 text-white">{{ $pageTitle }}</h5>
        </div>
        <div class="card-body pt-2">
           <div class="row">
               <div class="col-lg-6 mb-3">
                   <div class="card">
                       <div class="card-header border-bottom bg-primary d-flex py-3">
                           <h5 class="card-title mb-0 text-white">Socials Icon Settings</h5>
                       </div>
                       <div class="card-body">
                           <form action="{{ route('settings.social.store') }}" method="POST" enctype="multipart/form-data">
                               @csrf
                               <div class="form-group mt-3">
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
                               <div class="form-group mt-3 text-end">
                                   <button type="submit" class="text-right btn btn-primary">Update</button>
                               </div>
                           </form>
                       </div>
                   </div>
               </div>


                <div class="col-lg-6 mb-3">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary d-flex py-3">
                            <h5 class="card-title mb-0 text-white">General Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('settings.genarelSetting.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mt-3">
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

                                <div class="form-group mt-3 text-end">
                                    <button type="submit" class="text-right btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <!--/ Responsive Table -->
</div>
@endsection

@push('scripts')

@endpush
