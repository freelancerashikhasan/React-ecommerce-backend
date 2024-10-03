<style>
    @media (max-width: 575.98px){
        .cart-sidebar {
            height: 95vh !important;
        }
        .cart-sidebar-body{
            height: 63vh;
        }
    }

</style>

<!-- End Copyright -->
<div class="cart-sidebar">
    <div class="cart-sidebar-header">
        <h5> My Cart <span class="text-warning itemCount2">(5 item)</span> <a onclick="cartView();" class="float-right" href="javascript:">X</a></h5>
    </div>
    <div class="cart-sidebar-body">

        <table style="width: 100%;">
            <tbody class="AddCartBody">
                <tr><td class="text-center"><h6>No Item..</h6></td></tr>
            </tbody>
        </table>
    </div>
    <div class="cart-sidebar-footer" style="position: absolute; bottom: 0; left: 0; width: 100%;">
        <div class="cart-store-details">
            {{-- <p>Sub Total <strong class="float-right">$900.69</strong></p>
            <p>Delivery Charges <strong class="float-right text-danger">+ $29.69</strong></p> --}}
            <h6 class="mb-2 d-none">Total Point <strong class="float-right text-success total_point" style="color: #0cc5b7;">৳0.00</strong></h6>
            <h6>Sub Total <strong class="float-right text-success sub_total" style="color: #0cc5b7;">৳0.00</strong></h6>
        </div>
        <a href="{{ route('checkout.index') }}">
            <button class="btn btn-lg btn-secondary btn-block form-control" style="width: 100%;" type="button"><span class="float-left"><i class="mdi mdi-cart-outline"></i> Proceed to Checkout </span><span class="float-right"><strong class="sub_total_btn">৳0.00</strong> <span class="mdi mdi-chevron-right"></span></span></button>
        </a>
    </div>
</div>





@push('js')
    <script>
        function cartView(){
            // .cart-sidebar.toggled
            $('.cart-sidebar').toggleClass('toggled');
        }
    </script>
@endpush
