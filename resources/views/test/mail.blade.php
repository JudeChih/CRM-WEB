<?php
$title = "測試郵件";
?>

@extends('layouts.__sunwai_head')
@section('content')
<div class="case_setting_content col-md-10 col-sm-12 col-xs-12 col-md-offset-1 panel panel-info p_l_r_dis">

    <div class="panel-heading">
        <div class="case_setting_title">
            <h1>測試郵件</h1>
        </div>
    </div>

    <br><br><br>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','applyfortest') }}
        {{ Form::submit('申請試用',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','close_satisfaction') }}
        {{ Form::submit('滿意度調查',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','newcase') }}
        {{ Form::submit('新案件',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','overclose') }}
        {{ Form::submit('超過結案期限',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','overtake') }}
        {{ Form::submit('超過接案期限',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
</div>
<div class="row markting">
    <div class="col-lg-3">
        <h2>申請試用</h2>
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','applyfortest') }}
        {{ Form::label('使用者名稱','',['class'=>'control-label']) }}
        {{ Form::text('username' ,'qqqq',['class'=>'form-control']) }}
        {{ Form::submit('申請試用',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
    <div class="col-lg-3">
        <h2>申請試用</h2>
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','applyfortest') }}
        {{ Form::label('使用者名稱','',['class'=>'control-label']) }}
        {{ Form::text('username' ,'qqqq',['class'=>'form-control']) }}
        {{ Form::submit('申請試用',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
    <div class="col-lg-3">
        <h2>申請試用</h2>
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','applyfortest') }}
        {{ Form::label('使用者名稱','',['class'=>'control-label']) }}
        {{ Form::text('username' ,'qqqq',['class'=>'form-control']) }}
        {{ Form::submit('申請試用',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
    <div class="col-lg-3">
        <h2>申請試用</h2>
        {{ Form::open(['action' => array('ViewControllers\TestController@sendMail')]) }}
        {{ Form::hidden('mailtype','applyfortest') }}
        {{ Form::label('使用者名稱','',['class'=>'control-label']) }}
        {{ Form::text('username' ,'qqqq',['class'=>'form-control']) }}
        {{ Form::submit('申請試用',['class'=>'btn btn-primary']) }}
        {{ Form::close() }}
    </div>
</div>
@endsection