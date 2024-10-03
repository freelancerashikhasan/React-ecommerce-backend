
<style>
    .modal {
        z-index: 2100 !important;
    }
    @media(min-width: 992px){
        .modal-xl {
            max-width: 800px;
        }
    }
    @media(min-width: 1200px){
        .modal-xl {
            max-width: 1140px;
        }
    }

    .doc-view-image {
        width: 115px;
        border: 1px dashed #2baf63;
        border-radius: 4px;
    }

    .doc-view-image img {
        width: 100%;
        text-align: center;
        vertical-align: middle;
        margin: auto;
    }

</style>
<div class="modal fade" id="UserModalView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User View</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body dataviewBody">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@push('js')
    <script>
        function DataView(id){
            let url = "{{ route('ajax.get.UserDataView', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('.dataviewBody').html('');
                    $('.dataviewBody').html(data);
                    $('#UserModalView').modal('show');
                },
                error: function(){
                    warning_msg('User Data Not Found!');
                }
            });
        }
    </script>
@endpush
