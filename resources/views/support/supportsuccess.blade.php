<?php
$title = "成功發送";
?>
@extends('layouts.__sunwai_head')
@section('content')
<div class="j_form_style col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
    <div class="j_title col-md-12 col-sm-12 col-xs-12">
        <h1 class="text-center">成功送出</h1>
    </div>
    <div class="j_form col-md-12 col-sm-12 col-xs-12">
        <div class="p_l_r">
            <p>親愛的{{ $case_number[1] }}您好，感謝您的提問，您將會收到我們自動回覆的電子郵件；該信件包含案件編號，如需電話查詢，請告知服務人員案件編號。</p>
            <p>註 : 此為系統自動發送的信件，無須回覆。</p>
        </div>
    </div>
</div>
@endsection
