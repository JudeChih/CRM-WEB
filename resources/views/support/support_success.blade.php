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
    {{--  onload="parent.postMessage([{'s_height':document.body.scrollHeight}], 'http://localhost:8000/');" --}}
        <div class="j_form_style col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
            <div class="j_title col-md-12 col-sm-12 col-xs-12">
                <h1 class="text-center">成功送出</h1>
            </div>
            <div class="j_send col-md-12 col-sm-12 col-xs-12">
                <div class="p_l_r">
                    <p>親愛的您好，感謝您的提問，您將會收到我們自動回覆的電子郵件；該信件包含案件編號，如需電話查詢，請告知服務人員案件編號。</p>
                    <p>註 : 此為系統自動發送的信件，無須回覆。</p>
                </div>
            </div>
        </div>
    </body>
</html>