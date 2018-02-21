<?php
$title = "測試reCaptcha";
?>

@extends('layouts.__sunwai_head')
@section('content')
<div class="case_setting_content col-md-10 col-sm-12 col-xs-12 col-md-offset-1 panel panel-info p_l_r_dis">
    <div class="panel-heading">
        <div class="case_setting_title">
            <h1>測試reCaptcha</h1>
        </div>
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\TestController@testReCaptcha')]) }}
        {{ Form::hidden('mailtype','applyfortest') }}
        <div class="g-recaptcha" data-theme="light" data-sitekey="6Lf5Og4UAAAAANHwrHeUMkQ0DSCODpyOJGd8HBRO" data-callback="recaptcha_callback"></div>
        {{ Form::submit('TEST',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
</div>
<script src='https://www.google.com/recaptcha/api.js'></script>

<script type="text/javascript">
function recaptcha_callback() {
    alert("callback working");   
}
</script>
@endsection