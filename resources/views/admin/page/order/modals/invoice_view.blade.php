
<style>
    .table thead th, .table tbody th, td {
        vertical-align: middle !important;
    }
    .table thead th {
        border-bottom: 2px solid #dee2e6 !important;
    }
    @media (min-width: 576px){
        .modal-dialog{
            max-width: 80% !important;
            margin: 30px auto;
        }
    }
</style>
<div class="modal fade" id="invoiceViewModal">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h4 class="modal-title fw-bold text-white">Order View</h4>

                @if (auth()->user()->type == App\Helpers\Constant::USER_TYPE['customer'])
                    <button type="button" style="background: none; font-size: 24px; border: none; text-shadow: 0 1px 0 #fff; opacity: .5; " class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @else
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                @endif
            </div>
            <div class="modal-body invoice_view_body">

            </div>
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-success" id="printInvoiceBody">Print</button> --}}

                @if (auth()->user()->type == App\Helpers\Constant::USER_TYPE['customer'])
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                @else
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                @endif

            </div>

        </div>
    </div>
</div>


@push('js')

<script>
    function invoiceView(id) {
    let data_id = id;
    var url = "{{ route('ajax.invoice_view', ':id') }}";
    url = url.replace(':id', data_id);
    $.ajax({
        url: url,
        type: "GET",
        success: function(data) {

            // $('.invoice_view_body').html('');
            $('.invoice_view_body').html(data);

            $('#invoiceViewModal').modal('show');
        },
        error: function(error){
            Swal.fire({
                title: 'Error',
                text: 'Invoice not found !',
                icon: 'error',
                confirmButtonColor: '#FF0000',
                confirmButtonText: 'OK'
            });
        }
    });
}
</script>

@endpush
