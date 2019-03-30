{{--
What    :   The head tags containing Stylesheet Tags for admin side
Author  :   Alvin Mukiibi
Date    :   6th-February-2019
 --}}
 <html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSRF Token for requests that alter the database, it prevents against Cross-site Request Forgery --}}
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>" id="token">
    <title>{{config('app.name')}}</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}"/>

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" type="text/css">
    --}}
    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{asset('dist/img/favicon.ico')}}" type="image/x-icon">

    <!-- Styles -->
    {{-- for the multiple select button --}}
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/iCheck/flat/blue.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/morris/morris.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datepicker/datepicker3.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/daterangepicker/daterangepicker-bs3.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dist/css/adminlte.min.css')}}"/>


</head>
