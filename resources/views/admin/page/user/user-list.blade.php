@extends('layouts.admin.app')
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
        /* .modal .select2-container{
            z-index: 2100 !important;
        } */
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
                                    @if (request()->has('agent_list'))
                                        <a href="{{ route('admin.user.create') }}?agent" class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New Agent</a>
                                    @else
                                        <a href="{{ route('admin.user.create') }}" class="btn btn-success text-right"><i class="fas fa-plus-circle"></i> Add New User</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">



                            @if ((!request()->has('agent_list')) && (!request()->has('blocked_agent_list')) && (!request()->has('all_agent_list')) && (!request()->has('pharmacy_list')) && (!request()->has('blocked_pharmacy_list')) && (!request()->has('all_pharmacy_list')) && (!request()->has('customer_list')) && (!request()->has('blocked_customer_list')) && (!request()->has('all_customer_list')))
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="small-box bg-success">
                                            <div class="inner">
                                                <h3 class="total_count">0</h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">Total User Count</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="small-box bg-info">
                                            <div class="inner">
                                                <h3 class="approved_count">0</h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="#" class="small-box-footer">Approved User Count</a>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="small-box bg-warning">
                                            <div class="inner">
                                                <h3 class="non_approved_count">0</h3>
                                            </div>
                                            <div class="icon">
                                                <i class="ion ion-stats-bars"></i>
                                            </div>
                                            <a href="#" class="small-box-footer text-white">Non-Approved User Count</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row justify-content-center">
                                @if ((!request()->has('agent_list')) && (!request()->has('blocked_agent_list')) && (!request()->has('all_agent_list')) && (!request()->has('pharmacy_list')) && (!request()->has('blocked_pharmacy_list')) && (!request()->has('all_pharmacy_list')) && (!request()->has('customer_list')) && (!request()->has('blocked_customer_list')) && (!request()->has('all_customer_list')))
                                    <div class="col-sm-2 col-12">
                                        <label for="user_name">Search with Designation</label>
                                        <div class="input-group">
                                            <select name="designation" class="designation form-control select2" id="designation">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 col-12">
                                        <label for="user_name">Search with User Team</label>
                                        <div class="input-group">
                                            <input type="text" name="team_username" id="team_username" class="form-control" placeholder="Search by Username For Team">
                                        </div>
                                    </div>
                                @endif
                                <div class="col-sm-4 col-12">
                                    <label for="">Filter By Email Verification</label>
                                    <div class="input-group">
                                        <select name="email_verify" id="email_verify" class="form-control select2">
                                            <option value></option>
                                            <option value="verified">Verified</option>
                                            <option value="not_verified">Not Verified</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-6">
                                    <label for="button">&nbsp;</label>
                                    <button class="btn btn-block btn-secondary" id="clearFilter">Clear Filter</button>
                                </div>
                            </div>
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered table-striped DataTable" >
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">SL</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Name</th>
                                            <th class="text-center">Username</th>
                                            <th class="text-center">Email</th>
                                            <th class="text-center">Phone</th>
                                            <th class="text-center">Password</th>
                                            @if (request()->has('pharmacy_list'))
                                                <th class="text-center">Pharmacy Type</th>
                                            @endif
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Verified</th>
                                            <th class="text-center">Details</th>
                                            <th class="text-center" style="width: 250px !important;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- Modal -->
    <div class="modal fade" id="viewDocuments" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-secondary py-3">
                    <h5 class="modal-title text-white" id="exampleModalLabel1">User Documents</h5>
                    <button type="button" class="close state_close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body documentsBody">

                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>


            </div>
        </div>
    </div>



    @include('admin.page.user.userInfoModal')
@endsection

@push('js')
    @include('layouts.admin.all-select2')
    <script>

        $(document).ready(function(){
            designations();
            getUserCount();
        });

        function getUserCount(){
            url = "{{ route('ajax.get.allUserCount') }}";
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('.total_count').html(data.total_count);
                    $('.approved_count').html(data.approved_count);
                    $('.non_approved_count').html(data.pending_count);
                }
            });
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')
            }
        });

        // $('#clearFilter').click(function(){
        //     $("#team_username").val('');
        //     $("#email_verify").val('').trigger('change');
        //     designations();
        //     $('.DataTable').DataTable().ajax.reload();
        // });

        $(function() {
            var dataTable;

            var url = "{{ url()->current() }}";

            @if (request()->has('customer_list'))
                var url = "{{ url()->current() }}" + "?customer_list";
            @endif

            @if (request()->has('blocked_customer_list'))
                var url = "{{ url()->current() }}" + "?blocked_customer_list";
            @endif
            @if (request()->has('all_customer_list'))
                var url = "{{ url()->current() }}" + "?all_customer_list";
            @endif

            // $('#email_verify, #designation').change(function(){
            //     $('.DataTable').DataTable().ajax.reload();
            // });
            // $('#team_username').keyup(function(){
            //     $('.DataTable').DataTable().ajax.reload();
            // });

            dataTable = $('.DataTable').DataTable({
                processing: true,
                serverSide: true,
                pageLength: 100,
                dom: 'Bfrtip',
                buttons: [
                    // 'copy',
                    'excel',
                    'csv',
                    'pdf',
                    'print',
                    'reset'
                ],
                ajax: {
                    url: url,
                    data: function(d) {
                        // d.email_verifid = $("#email_verify").val();
                        // d.team_username = $("#team_username").val();
                        // d.designation = $("#designation").val();
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
                        data: 'image',
                        name: 'image',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'username',
                        name: 'username',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'show_password',
                        name: 'show_password',
                        className: 'text-center',
                        searchable: true
                    },
                    @if (request()->has('pharmacy_list'))
                        {
                            data: 'pharmacy_type',
                            name: 'pharmacy_type',
                            className: 'text-center',
                            searchable: false
                        },
                    @endif
                    {
                        data: 'status',
                        name: 'status',
                        className: 'text-center',
                        searchable: true
                    },
                    {
                        data: 'email_verified',
                        name: 'email_verified',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        data: 'details',
                        name: 'details',
                        className: 'text-center',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        className: 'text-center',
                        searchable: false,
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
    </script>

    <script>
        function documentView(user_id){
            $('.documentsBody').html('');

            url = "{{ route('ajax.get.user_documents', ':id') }}";
            url = url.replace(':id', user_id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    let nid_front = "{{ asset('uploads/user/self_document/') }}/" + data.nid_front;
                    let nid_back = "{{ asset('uploads/user/self_document/') }}/" + data.nid_back;
                    let chairman_certificate = "{{ asset('uploads/user/self_document/') }}/" + data.chairman_certificate;

                    let nominee_img = "{{ asset('uploads/user/nominee/') }}/" + data.nominee_img;
                    let nominee_nid_front = "{{ asset('uploads/user/nominee/') }}/" + data.nominee_nid_front;
                    let nominee_nid_back = "{{ asset('uploads/user/nominee/') }}/" + data.nominee_nid_back;

                    let guardian_img = "{{ asset('uploads/user/guardian/') }}/" + data.guardian_img;
                    let guardian_nid_front = "{{ asset('uploads/user/guardian/') }}/" + data.guardian_nid_front;
                    let guardian_nid_back = "{{ asset('uploads/user/guardian/') }}/" + data.guardian_nid_back;

                    let html = '';
                    html += '<div class="row"><div class="col-12"><label for="">Own Documents</label></div>';
                    html += '<div class="col-md-12 d-flex" style="overflow-x: scroll;">';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ nid_front +'"><img class="img-fluid" src="'+ nid_front +'" alt=""></a></div></div>';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ nid_back +'"><img class="img-fluid" src="'+ nid_back +'" alt=""></a></div></div>';

                    var filenames = data.certificate.split(',');
                    var filenamesExceptLast = filenames.slice(0, -1);

                    filenamesExceptLast.forEach(function(filename) {
                        let certificate_img = "{{ asset('uploads/user/self_document/') }}/" + filename;
                        html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ certificate_img +'"><img class="img-fluid" src="'+ certificate_img +'" alt=""></a></div></div>';
                    });

                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ chairman_certificate +'"><img class="img-fluid" src="'+ chairman_certificate +'" alt=""></a></div></div>';

                    html += '</div></div>';

                    html += '<div class="row"><div class="col-12"><label for="">Nommine Documents</label></div>';
                    html += '<div class="col-md-12 d-flex" style="overflow-x: scroll;">';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ nominee_img +'"><img class="img-fluid" src="'+ nominee_img +'" alt=""></a></div></div>';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ guardian_nid_front +'"><img class="img-fluid" src="'+ nominee_nid_front +'" alt=""></a></div></div>';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ nominee_nid_back +'"><img class="img-fluid" src="'+ nominee_nid_back +'" alt=""></a></div></div>';
                    html += '</div></div>';

                    html += '<div class="row"><div class="col-12"><label for="">Gurdian Documents</label></div>';
                    html += '<div class="col-md-12 d-flex" style="overflow-x: scroll;">';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ guardian_img +'"><img class="img-fluid" src="'+ guardian_img +'" alt=""></a></div></div>';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ guardian_nid_front +'"><img class="img-fluid" src="'+ guardian_nid_front +'" alt=""></a></div></div>';
                    html += '<div class="form-group"><div class="file" uk-lightbox><a href="'+ guardian_nid_back +'"><img class="img-fluid" src="'+ guardian_nid_back +'" alt=""></a></div></div>';
                    html += '</div></div>';

                    $('.documentsBody').html(html);
                    $('#viewDocuments').modal('show');
                }
            });
        }

        function change_status(user_id, status){
            let url = "{{ route('admin.user.chnage.status', ['user_id' => ':user_id', 'status' => ':status']) }}";
            url = url.replace(':user_id', user_id).replace(':status', status);

            let text = 'Do You Want To Approved this User?';
            let btnText = 'Approve';
            if(status == 1){
                text = 'Do You Want To Reject this User?';
                btnText = 'Reject';
            }

            Swal.fire({
                title: "Are you sure?",
                text: text,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: btnText
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
                                success_msg('User Status Change Successfully.');
                                $('.DataTable').DataTable().ajax.reload();
                            }
                        },
                        error: function(){
                            warning_msg('User Not Found!');
                        }
                    });
                }
            });
        }
    </script>
    <script>
        if(session('message')) {
                const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
                });
                Toast.fire({
                icon: "success",
                title: "{{session('message')}}"
            });
        }

        function permission(userid){
            url = "{{ route('ajax.get.user_documents', ':id') }}";
            url = url.replace(':id', userid);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#user_idd').val('');
                    $('#user_idd').val(data.id);
                    $('#with_trade_license').val(data.with_trade_permission).trigger('change');
                    $('#without_trade_license').val(data.without_trade_permission).trigger('change');
                    $('#user_approval_per').val(data.user_approval_per).trigger('change');
                    $('#userPermission').modal('show');
                },
                error: function(){
                    $('#user_idd').val('');
                    warning_msg('User Not Found!');
                }
            });
        }

        function permit_now(){
            var user_idd = $('#user_idd').val();
            var with_trade_permission = $('#with_trade_license').val();
            var without_trade_permission = $('#without_trade_license').val();
            var user_approval_per = $('#user_approval_per').val();

            var formData22 = new FormData();
            formData22.append('user_idd', user_idd);
            formData22.append('with_trade_permission', with_trade_permission);
            formData22.append('without_trade_permission', without_trade_permission);
            formData22.append('user_approval_per', user_approval_per);
            formData22.append('_token', $('meta[name="csrf-token"]').attr('content'));

            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData22, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.user.givePermission') }}",
                success: function(res) {
                    $('#user_idd').val('');
                    $('#with_trade_license').val('').trigger('change');
                    $('#without_trade_license').val('').trigger('change');
                    $('#user_approval_per').val('').trigger('change');
                    $('#userPermission').modal('hide');
                    success_msg('User Permissioned.');

                    $('.DataTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    $('#user_idd').val('');
                    $('#with_trade_license').val('').trigger('change');
                    $('#without_trade_license').val('').trigger('change');
                    $('#user_approval_per').val('').trigger('change');
                    warning_msg('User Not give any permission');
                }
            });

        }

    </script>
@endpush

