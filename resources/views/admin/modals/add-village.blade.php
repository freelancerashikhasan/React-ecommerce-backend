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
                        <select type="text" id="division" name="division" class="form-control select2" placeholder="Divisions">
                            @foreach ($divisions as $division)
                                <option value="{{ $division->id }}">{{ $division->name }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger division_Error"></span>
                    </div>
                    <div class="col-12 mb-1">
                        <label for="district" class="form-label">District <span class="text-danger">*</span></label>
                        <select type="text" id="district" name="district" class="form-control select2" placeholder="Select District">

                        </select>
                        <span class="text-danger district_Error"></span>
                    </div>

                    <div class="col-12 mb-1">
                        <label for="upazila" class="form-label">Upazila <span class="text-danger">*</span></label>
                        <select type="text" id="upazila" name="upazila" class="form-control select2" placeholder="Select Upazila">

                        </select>
                        <span class="text-danger upazila_Error"></span>
                    </div>

                    <div class="col-12 mb-1">
                        <label for="union" class="form-label">Union <span class="text-danger">*</span></label>
                        <select type="text" id="union" name="union" class="form-control select2" placeholder="Select Union">

                        </select>
                        <span class="text-danger union_Error"></span>
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
                        <label for="url" class="form-label">Word No <span class="text-info">( optional )</span></label>
                        <input type="text" id="url" name="url" class="form-control " placeholder="Enter Word No"/>
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

    @include('layouts.admin.all-select2')

    <script>
        $(document).ready(function(){
            division();
            district();
            upazila();
        });

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

            $('#district').val('').trigger('change');
            $('.district_Error').text('');

            $('#upazila').val('').trigger('change');
            $('.upazila_Error').text('');

            $('#union').val('').trigger('change');
            $('.union_Error').text('');

            $('#name_en').val('');
            $('.name_en_Error').text('');

            $('#name_bn').val('');
            $('.name_bn_Error').text('');

            $('#url').val('');
            $('.url_Error').text('');

        }

        function addCountry(){
            var union = $('#union').val();
            var name_en = $('#name_en').val();
            var name_bn = $('#name_bn').val();
            var url = $('#url').val();

            var formData = new FormData();
            formData.append('union_id', union);
            formData.append('name', name_en);
            formData.append('bn_name', name_bn);
            formData.append('word', url);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.settings.village.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('Village Added Successfully');
                    $('.country_close').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.union_id) {
                        $('.union_Error').text(errors.union_id);
                        $('#union').addClass('border-danger is-invalid');
                        $('#union').val('').trigger('change');
                        error('' + errors.union_id )
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
                    if (errors.word) {
                        $('.url_Error').text(errors.word);
                        $('#url').addClass('border-danger is-invalid');
                        $('#url').focus();
                        error('' + errors.word )
                    }
                }
            });

        }

        // Category Get Data For Edit
        function edit(id){
            var url = "{{ route('admin.settings.village.edit', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#row_id').val(data.village.id);
                    $('#division').val(data.division).trigger('change');

                    setTimeout(() => {
                        $('#district').val(data.district).trigger('change');
                    }, 1000);

                    setTimeout(() => {
                        $('#upazila').val(data.upazila).trigger('change');
                    }, 2000);

                    setTimeout(() => {
                        $('#union').val(data.union).trigger('change');
                    }, 3000);

                    $('#name_en').val(data.village.name);
                    $('#name_bn').val(data.village.bn_name);
                    $('#url').val(data.village.word);

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

            var union = $('#union').val();
            var name_en = $('#name_en').val();
            var name_bn = $('#name_bn').val();
            var url = $('#url').val();

            var formData = new FormData();
            formData.append('union_id', union);
            formData.append('name', name_en);
            formData.append('bn_name', name_bn);
            formData.append('word', url);

            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            var route = "{{ route('admin.settings.village.update', ':id') }}";
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
                    success_msg('Village Updated Successfully');
                    $('.country_close').click();
                    $('#datatable').DataTable().ajax.reload();
                },
                error: function(error) {
                    var errors = error.responseJSON.errors;
                    if (errors.union_id) {
                        $('.union_Error').text(errors.union_id);
                        $('#union').addClass('border-danger is-invalid');
                        $('#union').val('').trigger('change');
                        error('' + errors.union_id )
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
                    if (errors.word) {
                        $('.url_Error').text(errors.word);
                        $('#url').addClass('border-danger is-invalid');
                        $('#url').focus();
                        error('' + errors.word )
                    }
                }
            });
        }

        // Category Delete
        function destroy(id){
            var url = "{{ route('admin.settings.village.destroy', ':id') }}";
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
                                    success_msg('Village Deleted Successfully.');
                                    $('#datatable').DataTable().ajax.reload();
                                }
                            },
                            error: function(){
                                warning_msg('Village Not Found!');
                            }
                        });
                    }
             });
        }

    </script>
@endpush
