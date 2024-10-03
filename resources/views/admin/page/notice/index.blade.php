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
                            <h3 class="card-title">Notice Settings</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.settings.notice.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="notice_image">Notice Video<span class="text-danger"> Must me use less then 10MB MP4 File</span></label>
                                    <input type="file" class="form-control @error('notice_image') is-invalid @enderror" name="natice_img">
                                    @error('notice_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="notice_text">Text Notice</label>
                                    <textarea class="summernote" name="notice_text" id="description"></textarea>
                                    @error('notice_text')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group pt-3 text-right">
                                    <button type="submit" class="btn btn-success">Add Notice</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Notice Details</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @foreach ($data as $item)
                                <table class="table table-bordered ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Video</th>
                                            <th scope="col">Notice</th>
                                            <th scope="col" class="text-center">Action</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                @if ($item->notice_img != null)
                                                    <video width="100px" height="100px" autoplay="" muted="" loop="" playsinline="" src="{{ asset('uploads/notice/'.$item->notice_img) }}" data-object-fit="cover"></video>
                                                @else
                                                    N/A
                                                @endif
                                            </th>
                                            <td> {!! $item->notice_text !!}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.settings.notice.notice-delete',$item->id)}}" class="btn btn-danger btn-sm mr-2" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>

                                                <a href="{{ route('admin.settings.notice.notice-edit',$item->id)}}" class="btn btn-info btn-sm" title="Edit Data"><i class="fas fa-edit"></i> </a>
                                            </td>
                                            <td class="text-center">
                                                @if($item->status == 1)
                                                    <a href="{{ route('admin.settings.notice.notice.inactive',$item->id) }}" class="btn btn-danger btn-sm" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                                @else
                                                    <a href="{{ route('admin.settings.notice.notice.active', $item->id) }}" class="btn btn-success btn-sm" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endforeach

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
    <script>
        jQuery(function(e) {
            'use strict';
            $(document).ready(function() {
                $('#description').summernote({height: 200});
            });
        });

    </script>


@endpush
