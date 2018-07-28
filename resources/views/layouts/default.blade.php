<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>@yield('title','laravel for blog')</title>
    <!-- 网站小图标 -->
    <link rel="shortcut icon" href="{{ asset('/home/image/KDiyAbV0hj1ytHpRTOlVpucbLebonxeX.png') }}"/>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="{{ asset('/home/css/blog.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('/home/css/wangEditor.min.css') }}">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->
</head>

<body>

@include('layouts._header')

<div class="container">

    <div class="blog-header"></div>

    <div class="row">
            <div class="col-sm-8 blog-main">
                @yield('content')
            </div>
        
            <div id="sidebar" class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                @include('layouts._asider')
            </div>
    </div><!-- /.row -->
</div><!-- /.container -->
@include('layouts._footer')