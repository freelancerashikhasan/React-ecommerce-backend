<script>
// function get_address_book_data() {
//     url = "{{ route('ajax.address_book.get_address_book_data') }}";
//     $.ajax({
//         type: "GET",
//         url: url,
//         success: function (data) {
//             if (data.length === 0) {
//                 $('#get_address_book_data').html('<div class="col-12 text-center"><div class="alert alert-warning text-center">No address available</div></div>');
//             }
//             else{
//                 var html = '';
//                 $.each(data, function (index, value) {
//                     html += '<div class="col-md-6 py-1">';
//                     html += '<div class="card">';
//                     html += '<div class="card-body">';
//                     html += '<div class="form-group single-address-box">';
//                     html += '<h4 class="name">' + value.name + '</h4>';
//                     html += '<p class="phone">' + value.phone + '</p>';
//                     html += '<p class="address">' + value.address + ', ' + value.upazila.name + ', ' + value.district.name + ', ' + value.division.name +'</p>';
//                     // html += '<a class="action-btn btn btn-sm btn-secondary" href=""><i class="fa-solid fa-pen-to-square"></i></a>';
//                     html += '<a class="action-btn2 btn btn-sm btn-danger" href="javascript::" onclick="addressBookDestroy('+ value.id +')"><i class="fa-solid fa-xmark"></i></a>';
//                     html += '</div>';
//                     html += '</div>';
//                     html += '</div>';
//                     html += '</div>';
//                 });
//                 $('#get_address_book_data').html(html);
//             }


//         }
//     });
// }

function get_address_book_data() {
    url = "{{ route('ajax.address_book.get_address_book_data') }}";
    $.ajax({
        type: "GET",
        url: url,
        success: function (data) {
            if (data.length === 0) {
                $('#get_address_book_data').html('<div class="col-12 text-center"><div class="alert alert-warning text-center">No address available</div></div>');
            } else {
                var html = '';
                $.each(data, function (index, value) {
                    html += '<div class="col-md-6 py-1">';
                    html += '<label style="display:block;" for="delivery_address' + value.id + '">';
                    html += '<div class="card deliveryAddress shadow">';
                    html += '<input type="radio" name="delivery_address" id="delivery_address' + value.id + '" class="delivery_address d-none" value="' + value.id + '">';
                    html += '<div class="card-body">';
                    html += '<div class="form-group single-address-box">';
                    html += '<h4 class="name">' + value.name + '</h4>';
                    html += '<p class="phone">' + value.phone + '</p>';
                    html += '<p class="address">' + value.address + ', ' + value.upazila.name + ', ' + value.district.name + ', ' + value.division.name +'</p>';
                    html += '<a class="action-btn2 btn btn-sm btn-danger" href="javascript::" onclick="addressBookDestroy('+ value.id +')"><i class="fa-solid fa-xmark"></i></a>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</label>';
                    html += '</div>';
                });
                $('#get_address_book_data').html(html);
            }
        }
    });
}


</script>
