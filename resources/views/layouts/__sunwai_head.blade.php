<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta id="token" name="token" content="{{ csrf_token() }}">
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
<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://www.sunwai.com/" target="_blank">Sunwai</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav toto">
        <li><a href="/supportcase/caselist">案件列表</a></li>
        <li><a href="/supportcase/case_table">選擇休假日</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">各類表格<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/support/supportservice">技術支援服務</a></li>
            <li><a href="/support/close_satisfaction">滿意度調查</a></li>
            <li><a href="/applytest/applyfortest">申請試用</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">寄信系列<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="/emails/new_case_engineer">寄信給工程師</a></li>
            <li><a href="/emails/new_case_customer">寄信給客戶</a></li>
            <li><a href="/emails/close_satisfaction">寄封滿意度調查</a></li>
            <li><a href="/emails/over_take_deadline">寄信通知接案期限</a></li>
            <li><a href="/emails/over_close_deadline">寄信通知結案期限</a></li>
            <li><a href="/emails/apply_for_test">寄信申請試用資料</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true" style="font-size:20px;"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#" style="text-align: center;">註冊</a></li>
            <li><a href="/login/login" style="text-align: center;">登入﹝已做好﹞</a></li>
            <li><a href="#" style="text-align: center;">修改</a></li>
            <li><a href="#" style="text-align: center;">登出</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container-fluid">
    <div class="row">
        @yield('content')
    </div>
</div>

</body>
</html>