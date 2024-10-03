@extends('layouts.admin.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Notice</h1>
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
                            <h3 class="card-title">Notice Settings update</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.notice.update') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{  $data->id}}">
                                <div class="form-group">
                                    <label for="notice_image">Image<span class="text-danger"> *</span></label>
                                    <input type="file" class="form-control @error('notice_image') is-invalid @enderror" name="natice_img">
                                    @error('notice_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <div class="col-12 mt-3">
                                        <textarea class="summernote" name="description" id="description">
                                            {!! $data->notice_text !!}
                                        </textarea>
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

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@push('js')
    <script>


        jQuery(function(e) {
            'use strict';
            $(document).ready(function() {
                $('#description').summernote({height: 200});
            });
        });

    </script>


@endpush
