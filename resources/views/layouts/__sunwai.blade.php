<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>
        <title>{{ isset($title) ? $title.' | ' : '' }}翔偉資安</title>

        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="/css/css/stylesheets/style.css">

        <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-datetimepicker.zh-TW.js"></script>
        <script type="text/javascript" src="/js/style.js"></script>

    </head>
    <body>

        <div class="container-fluid">
            <div class="row">
                @yield('content')
            </div>
        </div>


    </body>
</html>