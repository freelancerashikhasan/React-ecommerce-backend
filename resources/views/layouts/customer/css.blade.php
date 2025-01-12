<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
<!-- waves.css -->
<link rel="stylesheet" type="text/css" media="all" href="{{ asset('user/assets/pages/waves/css/waves.min.css') }}">
<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/bootstrap/css/bootstrap.min.css') }}">
<!-- themify icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/icon/themify-icons/themify-icons.css') }}">
<!-- Font Awesome -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/icon/font-awesome/css/font-awesome.min.css') }}">
<!-- scrollbar.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/jquery.mCustomScrollbar.css') }}">
<!-- am chart export.css -->
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('user/assets/css/style.css') }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.2/sweetalert2.min.css" integrity="sha512-l1vPIxNzx1pUOKdZEe4kEnWCBzFVVYX5QziGS7zRZE4Gi5ykXrfvUgnSBttDbs0kXe2L06m9+51eadS+Bg6a+A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.18.2/dist/css/uikit.min.css" />


<style>
    .uk-lightbox.uk-open{
        z-index: 2100;
    }
    a{
        color: #333;
        transition: 0.3s;
        text-decoration: none !important;
    }
    a:hover{
        color: #8CC441;
        transition: 0.3s;
    }
    .pcoded .pcoded-header[header-theme="theme1"] {
        background: #ffffff;
        border-bottom: 1px solid #84b63f;
    }
    .pcoded .pcoded-header[header-theme="theme1"] .input-group-addon, .pcoded .pcoded-header[header-theme="theme1"] a{
        color: #84b63f;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item > li.active > a{
        background: #84b63f;
    }
    .pcoded .pcoded-navbar .pcoded-navigation-label[menu-title-theme="theme1"]{
        color: #84b63f;
    }
    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li:hover > a{
        color: #84b63f !important;
    }
    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li:hover > a i{
        color: #84b63f !important;
    }
    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item > li.active:hover > a{
        color: #fff !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered{
        background-color: transparent !important;
    }

    .select2-container .select2-selection--single{
        height: 38px;
        border: 1px solid #84b63f !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow{
        height: 38px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        padding: 5px 20px 4px 20px;
    }

    .text-c-purple, .text-c-red, .text-c-green, .text-c-blue {
        color: #84b63f;
        font-family: sans-serif;
    }


    input, select {
        height: 42px;
    }
    input.form-control, textarea.form-control {
        border: 1px solid #84b63f !important;
    }
    .form-control:disabled, .form-control[readonly] {
        background: transparent;
        text-align: center;
        color: #84b63f;
        font-weight: 500;
    }
    .form-group label {
        color: #333;
        font-weight: 500;
    }
    .table > thead > tr > th {
        padding: 10px 5px;
        background: #e4e8ea;
    }
    table.dataTable td, table.dataTable th {
        vertical-align: middle;
    }

    .table td, .table th{
        padding: 10px 5px;
    }

    div#social-links ul li {
        font-size: 25px;
        background: linear-gradient(135deg, #84b63f 0%,#84b63f 100%);
        margin-right: 3px;
        padding: 12px;
        border-radius: 50px;
    }

    div#social-links ul {
        display: flex;
    }

    div#social-links ul li a span {
        font-size: 15px !important;
    }

    div#social-links ul li a svg {
        font-size: 24px;
        color: #fff;
    }

    .social-button {
        border: 1px solid #84b63f;
        background: linear-gradient(135deg, #84b63f 0%,#84b63f 100%);
        padding: 9px 12px;
        text-align: center;
        vertical-align: middle;
        margin: auto;
        border-radius: 4px;
        transition: 0.5s;
    }

    .social-button span {
        font-size: 20px;
        color: #fff;
        transition: 0.5s;
    }
    .social-button:hover {
        background: #fff;
        transition: 0.5s;
    }
    .social-button:hover span {
        color: #84b63f;
        transition: 0.5s;
    }

    .copy-btn, .btn-primary{
        border: 1px solid #70AB43;
        background: linear-gradient(135deg, #70AB43 0%,#70AB43 100%);
        color: #fff;
        transition: 0.3s;
    }
    .copy-btn:hover, .btn-primary:hover{
        background: #fff;
        color: #70AB43;
        border: 1px solid #70AB43;
        transition: 0.5s;
    }
    .btn-primary i{
        color: #fff;
    }

    .btn-primary:hover i{
        color: #70AB43 !important;
        transition: 0.5s;
    }

    .bg-c-purple, .bg-c-red, .bg-c-green, .bg-c-blue, .bg-c-purple, .bg-c-red, .bg-c-green, .bg-c-blue, .bg-success {
        background: #84b63f !important;
    }
    .text-c-purple, .text-c-red, .text-c-green, .text-c-blue {
        color: #84b63f;
    }

    .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li .pcoded-submenu li.active > a, .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li .pcoded-submenu li:hover > a{
        color: #80b13e !important;
    }

    /* .pcoded .pcoded-navbar[active-item-theme="theme1"] .pcoded-item li:hover > a i{
        color: #fff !important;
    } */

    .pcoded[fream-type="theme1"] .page-header:before, .pcoded[fream-type="theme1"] .main-menu .main-menu-header:before {
        background: rgb(132 182 63 / 72%);
    }
    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgb(132 182 63 / 44%);
        box-shadow: 0 1px 20px 0 rgb(132 182 63 / 44%);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }

    .btn-sm {
        padding: 3px 4px;
        text-align: center;
    }

    .btn-sm i {
        font-size: 18px;
        margin: auto;
        vertical-align: middle;
        margin-top: 3px;
        margin-left: 2px;
    }

    .uploaded-img {
        width: 100px;
        max-height: 100px;
        border: 1px solid #73c586;
        margin-right: 8px;
        padding: 2px;
        border-radius: 2px;
        overflow: hidden;
    }

    span.img-remove {
        position: absolute;
        margin-left: -17px;
        margin-top: 0px;
        padding: 5px;
        line-height: 8px;
        background: #bddbc5;
        color: #e33b3b;
        border-radius: 50%;
        cursor: pointer;
    }

</style>

@include('layouts.frontend.animated')
