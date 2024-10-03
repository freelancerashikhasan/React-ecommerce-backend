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

                            <div class="row">
                                <div class="col-6" style="vertical-align: middle; margin: auto;">
                                    <h3 class="card-title text-light">{{ $pageTitle }}</h3>
                                </div>
                                <div class="col-6 text-right">
                                    <button type="button" id="addNewProductStock"  class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped DataTable" >
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 50px;">SL</th>
                                        <th class="text-left">Product Name</th>
                                        <th class="text-center">Note</th>
                                        <th class="text-center" style="width: 150px;">Qty</th>
                                        <th class="text-center" style="width: 150px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    @include('admin.page.product_stock.modals.add')
@endsection

@push('js')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')
            }
        });

        $(function() {
            var dataTable;

            dataTable = $('.DataTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                dom: 'Bfrtip',
                buttons: [
                    // 'copy',
                    'excel',
                    // 'csv',
                    // 'pdf',
                    'print',
                    'reset'
                ],
                ajax: {
                    url: "{{ url()->current() }}",
                    data: function(d) {
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        // Handle the error, e.g., display a message or take appropriate action
                        console.error("Error: " + textStatus, errorThrown);
                    },
                },

                columns: [
                    {
                        data: 'sl',
                        name: 'sl',
                        className: 'text-center',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'product',
                        name: 'product',
                        className: 'text-left',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'note',
                        name: 'note',
                        className: 'text-center',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'qty',
                        name: 'qty',
                        className: 'text-center',
                        orderable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        orderable: false
                    }

                ]

            });

        });

        $.fn.dataTable.ext.buttons.reset = {
            text: '<i class="fas fa-undo d-inline"></i> Reset' , action: function ( e, dt, node, config ) {
                dt.clear().draw();
                dt.ajax.reload();
            }
        };

        function edit(id){
            var url = "{{ route('admin.stock.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#id').val(data.id);
                    $('#product_id').val(data.product_id).trigger('change');
                    $('#note').val(data.note);
                    $('#qty').val(data.qty);

                    $('#addStockSave').addClass('d-none');
                    $('#UpdateStockSave').removeClass('d-none');
                    $('#addProductStock').modal('show');
                }
            });
        }

        function UpdateStockSave(){
            let id = $('#id').val();
            let product_id = $('#product_id').val();
            let note = $('#note').val();
            let qty = $('#qty').val();

            let formData2 = new FormData();
            formData2.append('id', id);
            formData2.append('product_id', product_id);
            formData2.append('note', note);
            formData2.append('qty', qty);
            formData2.append('_token', $('meta[name="csrf-token"]').attr('content'));

            let url = '{{ route('admin.stock.update', ':id') }}';
            url = url.replace(':id', id);
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData2, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: url,
                success: function(res) {
                    resetForm();
                    success_msg('Stock Update Successfully');
                    $('#addProductStock').modal('hide');
                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.product_id) {
                        $('.product_idError').text(errors.product_id);
                        $('#product_id').addClass('border-danger is-invalid');
                        $('#product_id').focus();
                        error_msg(''+errors.product_id);
                    }
                    if (errors.qty) {
                        $('.qtyError').text(errors.qty);
                        $('#qty').addClass('border-danger is-invalid');
                        $('#qty').focus();
                    }
                    if (errors.note) {
                        $('.noteError').text(errors.note);
                        $('#note').addClass('border-danger is-invalid');
                        $('#note').focus();
                    }

                }
            });
        }

        // Category Delete
        function destroy(id){
            var url = "{{ route('admin.stock.destroy', ':id') }}";
            url = url.replace(':id', id);
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: url,
                            success: function(data) {
                                if(data === 'data_have'){
                                    warning_msg('There is some data here so it cannot be deleted.');
                                }
                                else{
                                    success_msg('Stock Deleted Successfully.');
                                    $('.DataTable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('Stock Not Found!');
                            }
                        });
                    }
             });
        }
    </script>
@endpush

