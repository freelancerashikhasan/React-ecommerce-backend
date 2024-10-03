<script>
    function users(){
        $.ajax({
            url: "{{ route('get.users') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.username + '">' + value.name + '</option>';
                });
                $('#user').html(html);
            }
        });

        $("#user").select2({
            placeholder: "Select User",
        });
    }
    function clients(){
        $.ajax({
            url: "{{ route('get.users') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value>Select</option>';
                    html += '<option value="' + value.id + '">' + value.name + ' ( ' + value.username + ' ) </option>';
                });
                $('#clients').html(html);
            }
        });

        $("#clients").select2({
            placeholder: "Select User",
        });
    }

    function branch_list(){
        $.ajax({
            url: "{{ route('get.branchs') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                html += '<option value="null">Select Branch</option>';
                $.each(data, function(index, value) {
                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                $('#branch_id').html(html);
            }
        });

        $("#branch_id").select2({
            placeholder: "Select Branch",
        });
    }

    function category(){
        $.ajax({
            url: "{{ route('get.category') }}",
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.category_name + '</option>';
                });
                $('#category_id').html(html);
            }
        });

        $("#category_id").select2({
            placeholder: "Select Category",
        });
    }

    function sub_category(cat_id){
        var url = "{{ route('get.subcategory', ':id') }}";
        url = url.replace(':id', cat_id);
        $.ajax({
            url: url,
            dataType: 'json',
            success: function(data) {
                var html = '';
                $.each(data, function(index, value) {
                    html += '<option value="">Select</option>';
                    html += '<option value="' + value.id + '">' + value.subcategory + '</option>';
                });
                $('#subcategory_id').html(html);
            }
        });

        $("#subcategory_id").select2({
            placeholder: "Select Sub Category",
        });
    }

    function country(){
        $('#country').change(function(){
            let country = $('#country').val();
            url = "{{ route('ajax.get.states', ':country') }}";
            url = url.replace(':country', country);

            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    var html = '';
                    $.each(data, function(index, value) {
                        html += '<option value="">Select</option>';
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#states').html(html);
                }
            });

            let states = 1;
            url = "{{ route('ajax.get.tele_code', ':states') }}";
            url = url.replace(':states', states);

            $('#states').val();
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    $('#states').val(states);
                    $('#code').val(data);
                }
            });
        });
    }

    function division(){
        $('#division').change(function(){
            let division = $(this).val();
            url = "{{ route('ajax.get.district', ':division') }}";
            url = url.replace(':division', division);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    var html = '';
                    html += '<option value="">Select</option>';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#district').html(html);
                }
            });
        });
    }

    function district(){
        $('#district').change(function(){
            let district = $(this).val();
            url = "{{ route('ajax.get.upazila', ':district') }}";
            url = url.replace(':district', district);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    var html = '';
                    html += '<option value="">Select</option>';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#upazila').html(html);
                }
            });
        });
    }

    function district2(){
        $('#branch_district').change(function(){
            let district = $(this).val();
            url = "{{ route('ajax.get.upazila', ':district') }}";
            url = url.replace(':district', district);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    var html = '';
                    html += '<option value="">Select</option>';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#branch_upazila').html(html);
                }
            });
        });
    }

    function upazila(){
        $('#upazila').change(function(){
            let upazila = $(this).val();
            url = "{{ route('ajax.get.union', ':upazila') }}";
            url = url.replace(':upazila', upazila);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    var html = '';
                    html += '<option value="">Select</option>';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#union').html(html);
                }
            });
        });
    }

    function village(){
        $('#union').change(function(){
            let union = $(this).val();
            url = "{{ route('ajax.get.village', ':union') }}";
            url = url.replace(':union', union);
            $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                    var html = '';
                    html += '<option value="">Select</option>';
                    $.each(data, function(index, value) {
                        html += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                    $('#village').html(html);
                }
            });
        });
    }

    function designations(){
        url = "{{ route('ajax.get.designation') }}";
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                var html = '';
                html += '<option value="">Select</option>';
                $.each(data, function(index, value) {
                    html += '<option value="' + value.id + '">' + value.name + '</option>';
                });
                $('#designation').html(html);
            }
        });
    }

    function products(){
        url = "{{ route('ajax.get.products') }}";
        $.ajax({
            type: "GET",
            url: url,
            success: function(data) {
                var html = '';
                html += '<option value="">Select Product</option>';
                $.each(data, function(index, value) {
                    html += '<option value="' + value.id + '">' + value.title + '</option>';
                });
                $('#product_id').html(html);
            }
        });
    }




</script>
