<!-- Jquery js-->
<script src="{{ asset('admin/assets/js/jquery-3.5.1.min.js') }}"></script>

<!-- Bootstrap4 js-->
<script src="{{ asset('admin/assets/plugins/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>

<!--Othercharts js-->
<script src="{{ asset('admin/assets/plugins/othercharts/jquery.sparkline.min.js') }}"></script>

<!-- Circle-progress js-->
<script src="{{ asset('admin/assets/js/circle-progress.min.js') }}"></script>

<!-- Jquery-rating js-->
<script src="{{ asset('admin/assets/plugins/rating/jquery.rating-stars.js') }}"></script>

<!--Sidemenu js-->
<script src="{{ asset('admin/assets/plugins/sidemenu/sidemenu.js') }}"></script>

<!-- P-scroll js-->
<script src="{{ asset('admin/assets/plugins/p-scrollbar/p-scrollbar.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/p-scrollbar/p-scroll1.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/p-scrollbar/p-scroll.js') }}"></script>

<!-- DataTables & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- UIkit JS -->
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js"></script>



<!--INTERNAL Peitychart js-->
<script src="{{ asset('admin/assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/peitychart/peitychart.init.js') }}"></script>

<!--INTERNAL Apexchart js-->
<script src="{{ asset('admin/assets/js/apexcharts.js') }}"></script>

<!--INTERNAL ECharts js-->
<script src="{{ asset('admin/assets/plugins/echarts/echarts.js') }}"></script>

<!--INTERNAL Chart js -->
<script src="{{ asset('admin/assets/plugins/chart/chart.bundle.js') }}"></script>
<script src="{{ asset('admin/assets/plugins/chart/utils.js') }}"></script>

<!-- INTERNAL Select2 js -->
<script src="{{ asset('admin/assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/select2.js') }}"></script>

<!--INTERNAL Moment js-->
<script src="{{ asset('admin/assets/plugins/moment/moment.js') }}"></script>

<!--INTERNAL Index js-->
<script src="{{ asset('admin/assets/js/index1.js') }}"></script>

<!-- Simplebar JS -->
<script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<!-- Custom js-->
<script src="{{ asset('admin/assets/js/custom.js') }}"></script>

<!-- Switcher js-->
<script src="{{ asset('admin/assets/switcher/js/switcher.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.1/sweetalert2.min.js" integrity="sha512-lhtxV2wFeGInLAF3yN3WN/2wobmk+HuoWjyr3xgft42IY0xv4YN7Ao8VnYOwEjJH1F7I+fadwFQkVcZ6ege6kA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/js/all.min.js" integrity="sha512-MNA4ve9aW825/nbJKWOW0eo0S5f2HWQYQEIw4TkgLYMgqk88gHpSHJuMkJhYMQWKE7LmJMBdJZMs5Ua19QbF8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- jQuery UI (Required for datepicker) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<!-- jQuery UI CSS (for the datepicker styles) -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $( function() {
        $(".datepicker").datepicker({
            dateFormat: "dd M yy"
        });
    } );
</script>
@stack('js')


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

<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Choose one',
            searchInputPlaceholder: 'Search'
        });
        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose one'
        });

        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        $(document).on('select2:open', () => {
            console.log('Select2 opened');
            const searchField = document.querySelector('.select2-search__field');
            if (searchField) {
                console.log('Search field found');
                searchField.focus();
            } else {
                console.log('Search field not found');
            }
        });

    });
</script>
