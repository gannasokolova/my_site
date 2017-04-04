<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>{{$page->title}}</title>
    <meta name="keywords" content="{{$page->meta_keywords}}"/>
    <meta name="description" content="{{$page->meta_description}}"/>

    <!-- Bootstrap core CSS -->
    <link href="{{asset ('css/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset ('css/css/bootstrap-theme.min.css')}}" rel="stylesheet">
    <link href="{{asset ('css/css/style.css')}}" rel="stylesheet">

    <script type="text/javascript" src="{{asset ('css/jquery-3.1.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset ('css/js/bootstrap.min.js')}}"></script>

    @yield('page_script')


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="user">

@include('menu')













