<!-- Modal -->
<div class="modal fade" id="addProductStock" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-3">
                <h5 class="modal-title text-white" id="exampleModalLabel1">Add New Product Stock</h5>
                <button type="button" class="close category_close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="product_id" class="form-label">Select Product <span class="text-danger">*</span></label>
                        <select name="product_id" id="product_id" class="form-control select22">

                        </select>
                        <span class="text-danger product_idError"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="qty" class="form-label">Qty <span class="text-danger">*</span></label>
                        <input type="number" id="qty" name="qty" class="form-control @error('qty') is-invalid @enderror " value="{{ old('qty') }}" placeholder="Enter QTY"/>
                        <span class="text-danger qtyError"></span>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="note" class="form-label">Note </label>
                        <textarea name="note" id="note" rows="3" class="form-control" placeholder="Enter Note"></textarea>
                        <span class="text-danger noteError"></span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" id="formSubmit" class="btn btn-warning" onclick="resetForm();">Reset</button>
                <button type="button" id="addStockSave" class="btn btn-primary" onclick="addStockSave();">Add Stock</button>
                <button type="button" id="UpdateStockSave" class="btn btn-primary d-none" onclick="UpdateStockSave();">Update Stock</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    @include('layouts.admin.all-select2')

    <script>
        $(document).ready(function(){
            products();
        });

        $('.modal').on('shown.bs.modal', function () {
            $('.select22').select2({
                placeholder: "Select",
                dropdownParent: "#addProductStock"
            });
        });

        $('#addNewProductStock').click(function() {
            resetForm();
            $('#addProductStock').modal('show');

            $('#addStockSave').removeClass('d-none');
            $('#UpdateStockSave').addClass('d-none');
        });

        // Reset Category Data
        function resetForm(){
            $('#id').val('');

            $('#product_id').val('').trigger('change');
            $('#qty').val('');
            $('#note').val('');

            $('.product_idError').text('');
            $('#product_id').removeClass('border-danger is-invalid');

            $('.qtyError').text('');
            $('#qty').removeClass('border-danger is-invalid');

            $('.noteError').text('');
            $('#note').removeClass('border-danger is-invalid');


        }

        function addStockSave(){
            let product_id = $('#product_id').val();
            let qty = $('#qty').val();
            let note = $('#note').val();

            var formData = new FormData();
            formData.append('product_id', product_id);
            formData.append('qty', qty);
            formData.append('note', note);
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                type: "POST",
                dataType: "json",
                data: formData, // Use FormData for files
                contentType: false,
                processData: false, // Important when using FormData
                url: "{{ route('admin.stock.store') }}",
                success: function(res) {
                    resetForm();
                    success_msg('Stock Added Successfully');
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

                    // console.log(errors.category_name.);
                }
            });

        }

    </script>
@endpush
