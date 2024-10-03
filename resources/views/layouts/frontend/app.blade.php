<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ companyInfo()->company_name }} | {{ ($pageTitle) ? $pageTitle : companyInfo()->site_mettro }}</title>
    <meta name="description" content="{{ companyInfo()->meta_des }}">
    <meta name="author" content="{{ companyInfo()->company_name }}">
    <meta name="keywords" content="{{ companyInfo()->meta_keywords }}">

    <meta itemprop="name" content="{{ companyInfo()->company_name }} | {{ companyInfo()->site_mettro }}">
    <meta itemprop="description" content="{{ companyInfo()->meta_des }}">
    <meta itemprop="image" content="{{ asset('uploads/system/').'/'.companyInfo()->meta_image }}">

    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@publisher_handle">
    <meta name="twitter:title" content="{{ companyInfo()->meta_title }}">
    <meta name="twitter:description" content="{{ companyInfo()->meta_des }}">
    <meta name="twitter:creator" content="@author_handle">
    <meta name="twitter:image" content="{{ asset('uploads/system/').'/'.companyInfo()->meta_image }}">

    <!-- Open Graph data -->
    <meta property="og:title" content="{{ companyInfo()->meta_title }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ Request::server("HTTP_HOST") }}" />
    <meta property="og:image" content="{{ asset('uploads/system/').'/'.companyInfo()->meta_image }}" />
    <meta property="og:description" content="{{ companyInfo()->meta_des }}" />
    <meta property="og:site_name" content="{{ companyInfo()->company_name }}" />

   <!-- Favicon Icon -->
   <link rel="icon" type="image/png" href="{{ asset('uploads/system/').'/'.companyInfo()->favicon }}">

   @include('layouts.frontend.css')

   @stack('css')

</head>

<body>
    <!-- start page-wrap -->
    <div class="page-wrap">
        <!-- start preloader -->
        <div class="preloader">
            <div class="loader"></div>
        </div>
        <!-- end preloader -->

        @include('layouts.frontend.header')

        @yield('content')

        @include('layouts.frontend.footer')
    </div>

    @include('layouts.frontend.script')
    @stack('js')
</body>
</html>
