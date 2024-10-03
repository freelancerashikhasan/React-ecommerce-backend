<!-- Modal -->
<div class="modal fade" id="addCountryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Add Division</h5>
                <button type="button" class="close country_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rank_id">
                <div class="row">

                    <div class="col-12 mb-1">
                        <label for="division" class="form-label">Division <span class="text-danger">*</span></label>
                        <select type="text" id="division" name="division" class="form-control select2" placeholder="Divisions">\
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger division_Error"></span>
                    </div>

                    <div class="col-12 mb-1">
                        <label for="name_en" class="form-label">Name ( EN )<span class="text-danger">*</span></label>
                        <input type="text" id="name_en" name="name_en" class="form-control " placeholder="Enter Name ( EN )"/>
                        <span class="text-danger name_en_Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="name_bn" class="form-label">Name ( BN ) <span class="text-danger">*</span></label>
                        <input type="text" id="name_bn" name="name_bn" class="form-control " placeholder="Enter Name ( BN )"/>
                        <span class="text-danger name_bn_Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="url" class="form-label">URL <span class="text-danger">*</span></label>
                        <input type="text" id="url" name="url" class="form-control " placeholder="Enter Website URL"/>
                        <span class="text-danger url_Error"></span>
                    </div>
                </div>
                <input type="hidden" name="row_id" id="row_id">
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="formSubmit" class="btn btn-warning" onclick="resetForm();">Reset</button>
                <button type="button" id="addCountry" class="btn btn-primary" onclick="addCountry();">Add</button>
                <button type="button" id="UpdateCountry" class="btn btn-primary d-none" onclick="UpdateCountry();">Update</button>
            </div>
        </div>
    </div>
</div>
@push('js')

    <script>
        $(document)
        $('#addCountryModalBtn').click(function() {
            resetForm();
            $('#addCountry').removeClass('d-none');
            $('#UpdateCountry').addClass('d-none');
            $('#addCountryModal').modal('show');
        });

        // Reset Category Data
        function resetForm(){
            $('#division').val('').trigger('change');
            $('.division_Error').text('');

            $('#name_en').val('');
            $('.name_en_Error').text('');

            $('#name_bn').val('');
            $('.name_bn_Error').text('');

            $('#url').val('');
            $('.url_Error').text('');

        }

        function addCountry(){
            var division = $('#division').val();
            var name_en = $('#name_en').val();
            var name_bn = $('#name_bn').val();
            var url = $('#url').val();

            var formData = new FormData();
            formData.append('division_id', division);
            formData.append('name', name_en);
            formData.append('bn_name', name_bn);
            formData.append('url', url);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.settings.district.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('District Added Successfully');
                    $('.country_close').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.division_id) {
                        $('.division_Error').text(errors.division_id);
                        $('#division').addClass('border-danger is-invalid');
                        $('#division').val('').trigger('change');
                        error('' + errors.division_id )
                    }
                    if (errors.name) {
                        $('.name_en_Error').text(errors.name);
                        $('#name_en').addClass('border-danger is-invalid');
                        $('#name_en').focus();
                        error('' + errors.name )
                    }
                    if (errors.bn_name) {
                        $('.name_bn_Error').text(errors.bn_name);
                        $('#name_bn').addClass('border-danger is-invalid');
                        $('#name_bn').focus();
                        error('' + errors.bn_name )
                    }
                    if (errors.url) {
                        $('.url_Error').text(errors.url);
                        $('#url').addClass('border-danger is-invalid');
                        $('#url').focus();
                        error('' + errors.url )
                    }
                }
            });

        }

        // Category Get Data For Edit
        function edit(id){
            var url = "{{ route('admin.settings.district.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#row_id').val(data.id);
                    $('#division').val(data.division_id).trigger('change');
                    $('#name_en').val(data.name);
                    $('#name_bn').val(data.bn_name);
                    $('#url').val(data.url);

                    $('#formSubmit').addClass('d-none');
                    $('#addCountry').addClass('d-none');
                    $('#UpdateCountry').removeClass('d-none');
                    $('#addCountryModal').modal('show');
                }
            });
        }

        // Category Update
        function UpdateCountry(){
            var data_id = $('#row_id').val();

            var division = $('#division').val();
            var name_en = $('#name_en').val();
            var name_bn = $('#name_bn').val();
            var url = $('#url').val();

            var formData = new FormData();
            formData.append('division_id', division);
            formData.append('name', name_en);
            formData.append('bn_name', name_bn);
            formData.append('url', url);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var route = "{{ route('admin.settings.district.update', ':id') }}";
            route = route.replace(':id', data_id);
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: route,
                success: function(res) {
                    resetForm();
                    success_msg('District Updated Successfully');
                    $('.country_close').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.division_id) {
                        $('.division_Error').text(errors.division_id);
                        $('#division_en').addClass('border-danger is-invalid');
                        $('#division').val(errors.division_id).trigger('change');
                        error('' + errors.division_id )
                    }
                    if (errors.name) {
                        $('.name_en_Error').text(errors.name);
                        $('#name_en').addClass('border-danger is-invalid');
                        $('#name_en').focus();
                        error('' + errors.name )
                    }
                    if (errors.bn_name) {
                        $('.name_bn_Error').text(errors.bn_name);
                        $('#name_bn').addClass('border-danger is-invalid');
                        $('#name_bn').focus();
                        error('' + errors.bn_name )
                    }
                    if (errors.url) {
                        $('.url_Error').text(errors.url);
                        $('#url').addClass('border-danger is-invalid');
                        $('#url').focus();
                        error('' + errors.url )
                    }
                }
            });
        }

        // Category Delete
        function destroy(id){
            var url = "{{ route('admin.settings.district.destroy', ':id') }}";
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
                                if(data === 'not_delete'){
                                    warning_msg('Can Not Delete This!');
                                }
                                else{
                                    success_msg('District Deleted Successfully.');
                                    $('#datatable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('District Not Found!');
                            }
                        });
                    }
             });
        }

    </script>
@endpush
