<?php
$title = "成功發送";
?>
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
        <script type="text/javascript" src="/js/success_style.js"></script>

    </head>
    <body>
    {{-- onload="parent.postMessage(document.body.scrollHeight, 'http://192.168.30.102/');" --}}
        <div class="j_form_style col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
            <div class="j_title col-md-12 col-sm-12 col-xs-12">
                <h1 class="text-center">成功送出</h1>
            </div>
            <div class="j_send col-md-12 col-sm-12 col-xs-12">
                <div class="p_l_r">親愛的您好，已收到您的申請表，我們會馬上安排人員與您聯繫，請耐心等候，謝謝。</div>
            </div>
        </div>
    </body>
</html>