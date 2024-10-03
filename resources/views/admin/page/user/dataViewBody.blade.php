<div class="row">
    <div class="col-12">
        <div class="form-group mt-0">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-left" style="width: 200px;">Name</td>
                        <td class="text-left">{{ ($data->name != null) ? $data->name : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">Username</td>
                        <td class="text-left">{{ ($data->username != null) ? $data->username : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">Gender</td>

                        <td class="text-left">
                            @if ($data->gender == 1)
                                Male
                            @endif
                            @if ($data->gender == 2)
                                Female
                            @endif
                            @if ($data->gender == 3)
                                Others
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">Phone </td>
                        <td class="text-left">{{ ($data->phone != null) ? $data->phone : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">Email </td>
                        <td class="text-left">{{ ($data->email != null) ? $data->email : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">Division</td>
                        <td class="text-left">{{ ($data->division) ? $data->division->name : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">District</td>
                        <td class="text-left">{{ ($data->district) ? $data->district->name : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">Upazila</td>
                        <td class="text-left">{{ ($data->upazila) ? $data->upazila->name : 'N/A' }}</td>
                    </tr>
                    <tr>
                        <td class="text-left" style="width: 200px;">Union / Pourashava</td>
                        <td class="text-left">{{ ($data->union) ? $data->union->name : 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        {{-- <div class="form-group mt-1 mb-0">
            <label for="" style="font-size: 18px;">User Own Data</label>
        </div>
        <div class="form-group mt-0">
            <div class="table-responsive">
                <div class="d-flex">
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->image != null) ? asset('uploads/user/profile/'.$data->image) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->image != null) ? asset('uploads/user/profile/'.$data->image) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->nid_front != null) ? asset('uploads/user/self_document/'.$data->nid_front) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->nid_front != null) ? asset('uploads/user/self_document/'.$data->nid_front) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->nid_back != null) ? asset('uploads/user/self_document/'.$data->nid_back) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->nid_back != null) ? asset('uploads/user/self_document/'.$data->nid_back) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->certificate != null) ? asset('uploads/user/self_document/'.$data->certificate) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->certificate != null) ? asset('uploads/user/self_document/'.$data->certificate) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->chairman_certificate != null) ? asset('uploads/user/self_document/'.$data->chairman_certificate) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->chairman_certificate != null) ? asset('uploads/user/self_document/'.$data->chairman_certificate) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group mt-1 mb-0">
            <label for="" style="font-size: 18px;">Nominee Data</label>
        </div>
        <div class="form-group mt-0">
            <div class="table-responsive">
                <div class="d-flex">
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->nominee_img != null) ? asset('uploads/user/nominee/'.$data->nominee_img) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->nominee_img != null) ? asset('uploads/user/nominee/'.$data->nominee_img) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->nominee_nid_back != null) ? asset('uploads/user/nominee/'.$data->nominee_nid_back) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->nominee_nid_back != null) ? asset('uploads/user/nominee/'.$data->nominee_nid_back) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->nominee_nid_back != null) ? asset('uploads/user/nominee/'.$data->nominee_nid_back) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->nominee_nid_back != null) ? asset('uploads/user/nominee/'.$data->nominee_nid_back) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>



                </div>
            </div>
        </div> --}}

        {{-- <div class="form-group mt-0">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-left" style="width: 200px;">Nominee Phone Number</td>
                        <td class="text-left">{{ ($data->nominee_phone != null) ? $data->nominee_phone : 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-group mt-1 mb-0">
            <label for="" style="font-size: 18px;">Guardian Data</label>
        </div>
        <div class="form-group mt-0">
            <div class="table-responsive">
                <div class="d-flex">
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->guardian_img != null) ? asset('uploads/user/guardian/'.$data->guardian_img) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->guardian_img != null) ? asset('uploads/user/guardian/'.$data->guardian_img) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->guardian_nid_front != null) ? asset('uploads/user/guardian/'.$data->guardian_nid_front) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->guardian_nid_front != null) ? asset('uploads/user/guardian/'.$data->guardian_nid_front) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>
                    <div class="doc-view-image mr-2" uk-lightbox>
                        <a href="{{ ($data->guardian_nid_front != null) ? asset('uploads/user/guardian/'.$data->guardian_nid_front) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}">
                            <img src="{{ ($data->guardian_nid_front != null) ? asset('uploads/user/guardian/'.$data->guardian_nid_front) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg' }}" alt="">
                        </a>
                    </div>



                </div>
            </div>
        </div> --}}

        {{-- <div class="form-group mt-0">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td class="text-left" style="width: 200px;">Guardian Phone Number</td>
                        <td class="text-left">{{ ($data->guardian_phone != null) ? $data->guardian_phone : 'N/A' }}</td>
                    </tr>
                </tbody>
            </table>
        </div> --}}

    </div>
</div>
