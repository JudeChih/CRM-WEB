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
        <div class="p_l_r">親愛的"{{ $case_number[1] }}"您好，已收到您的申請表，我們會馬上安排人員與您聯繫，請耐心等候，謝謝。</div>
    </div>
</div>
@endsection