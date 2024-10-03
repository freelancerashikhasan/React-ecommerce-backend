 <!-- All JavaScript files Here
********************************************* -->
<!-- jquery Plugins -->
<script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
<!--**************** Bootstrap Plugins ****************-->
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
<!--**************** modernizr Plugins ****************-->
<script src="{{ asset('frontend/assets/js/modernizr.custom.js') }}"></script>
<!--**************** all-plugin-bundle ****************-->
<script src="{{ asset('frontend/assets/js/all-plugin-bundle.js') }}"></script>
<!--**************** mobail meanmenu ****************-->
<script src="{{ asset('frontend/assets/js/jquery.meanmenu.min.js') }}"></script>
<!--**************** all script file this template ****************-->
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>




{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script> --}}
<script src="{{ asset('js/share.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.js"
    integrity="sha512-lhtxV2wFeGInLAF3yN3WN/2wobmk+HuoWjyr3xgft42IY0xv4YN7Ao8VnYOwEjJH1F7I+fadwFQkVcZ6ege6kA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Custom -->
<script src="{{ asset('frontend/js/custom.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="carf-token"]').attr('content')
        }
    });

    $(document).ready(function(){
        addCartData();

        $('.select2').select2({
            placeholder: "Select"
        });
    });



    function addCart(product_id, qty) {
        var qty = $('.quantity').val() || qty;
        url = "{{ route('addCart.store') }}";
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                product_id: product_id,
                qty: qty,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if (data == 'success') {
                    Swal.fire({
                        title: 'Congratulation',
                        text: "Add to Cart Successfull.",
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    });
                    addCartData();
                } else if (data == 'increase') {
                    Swal.fire({
                        title: 'Congratulation',
                        text: "Product Quantity Increased.",
                        icon: 'info',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    });
                    addCartData();
                } else {
                    Swal.fire({
                        title: 'Sorry',
                        text: "Something Wrong.",
                        icon: 'warning',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes'
                    });
                }

            }
        });
    }

    function addCartData() {
        url = "{{ route('addCart.get.data') }}";
        $.ajax({
            type: "GET",
            dataType: "json",
            url: url,
            success: function(data) {

                $('.itemCount').html(0);
                $('.itemCount2').html('(0 item)');
                $('.itemCount').html(data.length);
                $('.itemCount2').html('('+ data.length +' item)');
                $('.itemCount3').html(0);
                $('.itemCount3').html(data.length);

                if('{{ Route::currentRouteName() }}' == 'checkout.index'){
                    $('.itemCountCheckout').html('(0 item)');
                    $('.itemCountCheckout').html('('+ data.length +' item)');
                    if(data.length > 0){
                        $('.order-confirm-section').removeClass('d-none');
                    }
                    else{
                        $('.order-confirm-section').addClass('d-none');
                    }
                }

                var html = '';
                if(data.length != 0){
                    $.each(data, function(index, value) {

                        var priceText = '';
                        var product_price = 0;
                        if((value.product.offer_price == 0) || (value.product.offer_price == null)){
                            priceText = '<p class="offer-price mb-0">৳'+ value.product.price +'/p>';
                            product_price = value.product.price;
                        }
                        else{
                            priceText = '<p class="offer-price mb-0">৳'+ value.product.offer_price +' <i class="mdi mdi-tag-outline"></i> <del class="regular-price">৳'+ value.product.price +'</del></p>';
                            product_price = value.product.offer_price;
                        }
                        var proImage = '{{ asset('frontend/img/item/1.jpg') }}';
                        if((value.product.thumbnail != null)){
                            proImage = '{{ asset('uploads/product') }}/' + value.product.thumbnail;
                        }

                        html += '<tr> <td> <div class="cart-list-product"> ';

                        html += '<input type="hidden" class="product_id" name="product_id[]" value="'+ value.product.id +'">';
                        html += '<input type="hidden" class="product_price" name="product_price[]" value="'+ product_price +'">';
                        html += '<input type="hidden" class="total_product_price" name="total_product_price[]" value="'+ (product_price * value.quantity).toFixed(2) +'">';
                        html += '<input type="hidden" class="product_point" name="product_point[]" value="'+ value.product.point +'">';
                        html += '<input type="hidden" class="total_product_point" name="total_product_point[]" value="'+ (value.product.point * value.quantity).toFixed(2) +'">';

                        html += '<a class="float-right remove-cart" href="javascript:" onclick="removeCartData('+ value.product.id +');">x</a>';

                        html += '<img class="img-fluid" src="'+ proImage +'" alt="">';

                        html += '<h5><a href="#">'+ value.product.title.substring(0, 30) +'</a></h5>';

                        // html += ' <h6 class="text-warning"><strong><span class="text-warning fas fa-coins"></span></strong> '+ value.product.point +' Point</h6>';

                        html += priceText;

                        html += '<div class="product_plus_minus mt-1 mb-2"><button id="decrement"><i class="fas fa-minus"></i></button><input type="text" readonly class="quantity_row" id="quantity_row" name="quantity_row[]" min="1" value="' + value.quantity + '"><button id="increment"><i class="fas fa-plus"></i></button></div>';

                        html += '</div> </td></tr>';

                    });
                }
                else{
                    var html = '<tr><td class="text-center"><h6>No Item..</h6></td></tr>';
                }

                $('.AddCartBody').html('');
                $('.AddCartBody').html(html);

                if('{{ Route::currentRouteName() }}' == 'checkout.index'){
                    $('.checkoutItemBody').html('');
                    $('.checkoutItemBody').html(html);
                }

                updateSubTotal();
                updatePointTotal();
            }
        });
    }

    $(document).on("click", "#decrement", function() {
        var row = $(this).closest("tr");
        var product_id = parseInt(row.find(".product_id").val()) || 0;
        var quantity_row = parseInt(row.find(".quantity_row").val()) || 0;
        var product_price = parseFloat(row.find(".product_price").val()) || 0;
        var product_point = parseFloat(row.find(".product_point").val()) || 0;
        if (quantity_row > 1) {
            var result_qty = parseInt(quantity_row - 1);
            row.find(".quantity_row").val(result_qty);
            row.find(".total_product_price").val((product_price * result_qty).toFixed(2));
            row.find(".total_product_point").val((product_point * result_qty).toFixed(2));
            updateSubTotal();
            updatePointTotal();
            updateCookie(product_id, result_qty);
        }
    });

    $(document).on("click", "#increment", function() {
        var row = $(this).closest("tr");
        var product_id = parseInt(row.find(".product_id").val()) || 0;
        var quantity_row = parseInt(row.find(".quantity_row").val()) || 0;
        var product_price = parseFloat(row.find(".product_price").val()) || 0;
        var product_point = parseFloat(row.find(".product_point").val()) || 0;
        var result_qty = parseInt(quantity_row + 1);
        row.find(".quantity_row").val(result_qty);
        row.find(".total_product_price").val((product_price * result_qty).toFixed(2));
        row.find(".total_product_point").val((product_point * result_qty).toFixed(2));
        updateSubTotal();
        updatePointTotal();
        updateCookie(product_id, result_qty);
    });

    //<--------------------Created by Ashik ----------------------->
    $(document).on("keyup", "#quantity_row", function() {
       setTimeout(() => {
            var row = $(this).closest("tr");
            var product_id = parseInt(row.find(".product_id").val()) || 0;
            var quantity_row = parseInt(row.find(".quantity_row").val()) || 0;
            var product_price = parseFloat(row.find(".product_price").val()) || 0;
            var product_point = parseFloat(row.find(".product_point").val()) || 0;
            var result_qty = parseInt(quantity_row);
            row.find(".quantity_row").val(result_qty);
            row.find(".total_product_price").val((product_price * result_qty).toFixed(2));
            row.find(".total_product_point").val((product_point * result_qty).toFixed(2));
            updateSubTotal();
            updatePointTotal();
            updateCookie(product_id, result_qty);
       }, 1000);
    });

    function updateSubTotal(){
        var totalSubTotal = 0;
        $(".total_product_price").each(function() {
            totalSubTotal += parseFloat($(this).val()) || 0;
        });
        $(".sub_total").html('');
        $(".sub_total").html('৳' + totalSubTotal.toFixed(2));

        if('{{ Route::currentRouteName() }}' == 'checkout.index'){
            $('.sub_total_checkout').html('');
            $('.sub_total_checkout').html('৳' + totalSubTotal.toFixed(2));
        }

        $(".sub_total_btn").html('৳' + totalSubTotal.toFixed(2));
    }

    function updatePointTotal(){
        var total = 0;
        $(".total_product_point").each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $(".total_point").html('');
        $(".total_point").html('<span class="text-warning fas fa-coins mr-2"></span>' + total.toFixed(2));

        if('{{ Route::currentRouteName() }}' == 'checkout.index'){
            $(".total_point_checkout").html('');
            $(".total_point_checkout").html('<span class="text-warning fas fa-coins mr-2"></span>' + total.toFixed(2));
        }
    }

    function updateCookie(product_id, qty){
        url = "{{ route('addCart.update') }}";
        $.ajax({
            type: "POST",
            dataType: "json",
            data: {
                product_id: product_id,
                quantity: qty,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            success: function(data) {
                if(data == 'error'){
                    addCartData();
                }
                else{
                    addCartData();
                }
            }
        });
    }

    function removeCartData(product_id){
        url = "{{ route('addCart.destroy', ':product_id') }}";
        url = url.replace(':product_id', product_id);
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                addCartData();
            }
        });
    }

</script>

<script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
@if (session()->has('success'))
    {{ session()->get('success') }}
@endif
@if (session()->has('error'))
    {{ session()->get('error') }}
@endif


<script>
    function error_msg(mes) {
        flasher.error(mes);
    }
    function warning_msg(mes) {
        flasher.warning(mes);
    }
    function success_msg(mes) {
        flasher.success(mes);
    }
    function info_msg(mes) {
        flasher.info(mes);
    }
</script>
