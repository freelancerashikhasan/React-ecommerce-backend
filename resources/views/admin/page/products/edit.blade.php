@extends('layouts.admin.app')
@push('css')
    <style>
        table#product-extra-info tbody tr td {
            background: #f5f5f9 !important;
            border: 1px solid #ddd !important;
            padding: 6px !important;
        }
    </style>
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $pageTitle ?? 'N/A' }}</h1>
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
                                    <h3 class="card-title text-light">{{ $pageTitle ?? 'N/A' }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <a href="{{ route('admin.product.index') }}" class="btn btn-success text-right">Product List</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="title">Product Title <span class="text-danger"> *</span></label>
                                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Product Title" value="{{ (old('title')) ? old('title') : $product->title }}">
                                            @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group mt-2">
                                            <label for="sub_title">Product Sub Title <span class="text-danger"> *</span></label>
                                            <input type="text" name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror" placeholder="Enter Product Sub Title" value="{{ (old('sub_title')) ? old('sub_title') : $product->sub_title }}">
                                            @error('sub_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Customer  --}}
                                <div class="row">
                                    <div class="col-sm-4 col-md-6 d-none">
                                        <div class="form-group mt-2">
                                            <label for="point">Product Point <span class="text-danger"> ( Default Point is 0 (zero) ) </span></label>
                                            <input type="number" name="point" id="point" class="form-control @error('point') is-invalid @enderror" placeholder="Product Point" value="{{ (old('point')) ? old('point') : $product->point }}">
                                            @error('point')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="price">Original Price  <span class="text-danger"> * </span></label>
                                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="Product Original Price" value="{{ (old('price')) ? old('price') : $product->price }}">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-6">
                                        <div class="form-group mt-2">
                                            <label for="price">Offer Price </label>
                                            <input type="number" name="offer_price" id="offer_price" class="form-control @error('offer_price') is-invalid @enderror" placeholder="Product Offer Price" value="{{ (old('offer_price')) ? old('offer_price') : $product->offer_price }}">
                                            @error('offer_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-3">
                                                    <label for="category_id">Product Categoy <span class="text-danger"> *</span></label>
                                                    <select name="category_id" id="category_id" class="form-control select2"></select>
                                                    @error('category_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="subcategory_id">Product Sub Categoy <span class="text-dark">( Optional )</span></label>
                                                    <select name="subcategory_id" id="subcategory_id" class="form-control select2"></select>
                                                    @error('subcategory_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-2 mb-0 pb-1 border-bottom">
                                                    <label for="">Product Extra Information <span class="text-dark">( Optional )</span></label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                {{-- <div class="form-group w-100" style="border: 1px solid #a3afbb; border-radius: 4px; padding: 4px;">
                                                    <div style="width: 40px;" class="text-center">1</div>
                                                    <div class="text-center">1</div>
                                                    <div style="width: 40px;" class="text-center">1</div>
                                                </div> --}}
                                                <table class="table table-borderd" id="product-extra-info">
                                                    <tbody>
                                                        @foreach ($product->product_info as $key => $info)
                                                            <tr>
                                                                <td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_title" placeholder="Info Title" name="info_title[]" value="{{ $info->info_title }}"></td>

                                                                <td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_details" placeholder="Info Details" name="info_details[]"  value="{{ $info->info_details }}"></td>

                                                                <td class="text-center" style="width: 40px;"><input type="hidden" name="info_id[]" value="{{ $info->id }}"> <input type="hidden" name="row_id[]" value="{{ ++$key }}"> <button type="button" class="btn btn-sm btn-danger p-1 px-2 delete-row" onclick="infoRemove({{ $info->id }});">X</button></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <button type="button" class="btn btn-sm btn-primary" onclick="addInfo();">Add New</button>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="featured_product" name="featured_product" value="1" @if($product->featured_product == 1) checked @endif>
                                                    <input type="hidden" id="featured_product_hidden" name="featured_product" value="0">
                                                    <label class="form-check-label" for="featured_product">
                                                        Featured Product
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="new_arrival" name="new_arrival" value="1"  @if($product->new_arrival == 1) checked @endif>
                                                    <input type="hidden" id="new_arrival_hidden" name="new_arrival" value="0">
                                                    <label class="form-check-label" for="new_arrival">
                                                        New Arrival
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="today_deals" name="today_deals" value="1"   @if($product->today_deals == 1) checked @endif>
                                                    <input type="hidden" id="today_deals_hidden" name="today_deals" value="0">
                                                    <label class="form-check-label" for="today_deals">
                                                        Today's Deals
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group mt-3">
                                                    <label for="thumbnail">Product Thumbnail <span class="text-danger">*</span></label>
                                                    <input type="file" name="thumbnail" id="thumbnail" class="form-control" placeholder="Product Thumbnail">
                                                    @error('thumbnail')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                    @if ($product->thumbnail != null)
                                                        <div class="thumbnail">
                                                            <div class="uploaded-img"  style="min-height: 50px; vertical-align: middle;">
                                                                <img style="min-height: 50px" src="{{ asset('uploads/product').'/'.$product->thumbnail }}" alt="">
                                                                <span class="img-remove" onclick="thumbnailRemove('{{ $product->id }}', 'thumbnail');">x</span>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="form-group mt-3">
                                                    <label for="featured_image">Product Featured Images<span class="text-dark">( Optional )</span></label>
                                                    <input type="file" name="featured_image[]" id="featured_image" class="form-control" placeholder="Product Thumbnail" multiple>
                                                    @error('featured_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    @if ($product->featuredImages)
                                                        <div class="d-flex">
                                                            @foreach ($product->featuredImages as $image)
                                                                <div class="featuredImages_{{ $image->id }} mr-3">
                                                                    <div class="uploaded-img"  style="min-height: 50px; vertical-align: middle;">
                                                                        <img style="min-height: 50px" src="{{ asset('uploads/product').'/'.$image->image }}" alt="">
                                                                        <span class="img-remove" onclick="featuredImageRemove({{ $image->id }},'featuredImages_{{ $image->id }}');">x</span>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12 mt-3">
                                        <textarea name="description" id="description">{{ (old('description')) ? old('description') : $product->description }}</textarea>
                                    </div>
                                    <div class="col-12 mt-3 d-none">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" name="policy" type="checkbox" id="privacy_policy" @if ($product->policy == App\Helpers\Constant::POLICY_STATUS['active']) checked @endif />
                                            <label class="form-check-label" for="privacy_policy">Privacy Policy</label>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-1 d-none">
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" name="terms" type="checkbox" id="terms" @if ($product->terms == App\Helpers\Constant::TERMS_STATUS['active']) checked @endif />
                                            <label class="form-check-label" for="terms">Terms Of Service</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update Product</button>
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
        document.querySelectorAll('.form-check-input').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                if (checkbox.checked) {
                    checkbox.nextElementSibling.value = 1;
                } else {
                    checkbox.nextElementSibling.value = 0;
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            category();
            setTimeout(() => {
                $("#category_id").val('{{ $product->category_id }}').trigger('change');
                sub_category('{{ $product->category_id }}');
            }, 2000);

            setTimeout(() => {
                $("#subcategory_id").val('{{ $product->subcategory_id }}').trigger('change');
            }, 3000);
        });
        $('#category_id').change(function(){
            var cat_id =$('#category_id').val();
            sub_category(cat_id);
        });
        jQuery(function(e) {
            'use strict';
            $(document).ready(function() {
                $('#description').summernote({height: 200});
            });
        });


        $(document).on("click", ".delete-row", function() {
            var row = $(this).closest("tr");
            var rowId = row.find("input[name='row_id']").val();
            row.remove();
            success_msg('Product Extra Information Item Removed.');
        });

        function infoRemove(id){
            var url = "{{ route('admin.product.info.item', ':id') }}";
            url = url.replace(':id', id);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    // success_msg('Product Extra Information Item Removed.');

                },
                error: function(){
                    warning_msg('Product Not Found!');
                }
            });
        }

        function addInfo(){
            var rowCount = $("#product-extra-info tbody tr").length + 1; // initial row index number
            var newRow = $(
                '<tr>' +

                '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_title" placeholder="Info Title" name="info_title[]"></td>' +

                '<td class="text-center" style="width: 50%;"><input required type="text" class="form-control info_details" placeholder="Info Details" name="info_details[]"></td>' +

                '<td class="text-center" style="width: 40px;"><input type="hidden" name="row_id[]" value="'+ rowCount +'"><button type="button" class="btn btn-sm btn-danger p-1 px-2 delete-row">X</button></td>' +

                '</tr>'
            );
            $("#product-extra-info tbody").append(newRow);
        }


        function featuredImageRemove(id, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this featured Image?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('admin.product.feature.image.remove', ':id') }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+class_name).html('');
                        }
                    });

                }
            });
        }
        function thumbnailRemove(id, class_name){
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you remove this thumbnail Image?",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = '{{ route('admin.product.thumbnail.remove', ':id') }}';
                    url = url.replace(':id', id);
                    $.ajax({
                        type: "GET",
                        url: url,
                        success: function(data) {
                            $('.'+class_name).html('');
                        }
                    });

                }
            });
        }

    </script>


@endpush
