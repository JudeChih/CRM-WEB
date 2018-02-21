<?php
$title = "設定支援工程師";
?>
@extends('layouts.__sunwai_head')
@section('content')
<script type="text/javascript" src="/js/case_setting_style.js"></script>

<div class="case_setting_content col-md-10 col-sm-12 col-xs-12 col-md-offset-1 panel panel-info p_l_r_dis">
    <div class="panel-heading">
        <div class="case_setting_title">
            <h1>設定支援工程師</h1>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-md-12 col-sm-12 col-xs-12 case_setting_search">
            {{ Form::open(['action'=>'ViewControllers\SupportCase\SupportCaseSupportController@supportCaseSupport','class'=>'navbar-form navbar-left']) }}
            {{ Form::hidden('actiontype', 'search') }}
            {{ Form::hidden('support_id', $support_id) }}
            {{ Form::text('querycondition' , isset($querycondition) ? $querycondition : '',['class'=>'form-control']  ) }}
            {{ Form::button('查詢',['name' => 'submit','type'=>'submit' ,'class'=>'btn btn-info' ,'value'=>'search']) }}
            {{ Form::close() }}

            {{ Form::button('確認',['name' => 'form_send_check' ,'class'=>'btn btn-info navbar-right nav_select' ,'value'=>'form_send_check']) }}

            {{ Form::open(['action' => array('ViewControllers\SupportCase\SupportCaseDetailController@supportCaseDetail')]) }}
            {{ Form::hidden('support_id', $support_id) }}
            {{ Form::submit('返回',['name' => 'back' ,'class'=>'btn btn-info navbar-right nav_select' ,'value'=>'back']) }} 
            {{ Form::close() }}
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 case_setting_ex">
            <div class="col-md-6 col-sm-6 col-xs-6">工程師名稱</div>
            <div class="col-md-6 col-sm-6 col-xs-6">部門名稱</div>
        </div>
        @foreach ($engineerlist as $case)
        {{ Form::open(['action' => array('ViewControllers\SupportCase\SupportCaseSupportController@supportCaseSupport')]) }}
        <div class="case_setting_detail col-md-12 col-sm-12 col-xs-12">
            {{ Form::hidden('actiontype', 'save') }}
            {{ Form::hidden('support_id', $support_id) }}
            {{ Form::hidden('querycondition',  isset($querycondition) ? $querycondition : '') }}
            {{ Form::hidden('ud_id', $case->ud_id) }}
            {{ Form::hidden('password', 'password') }}
            <div class="col-md-6 col-sm-6 col-xs-6">{{ $case->ud_cname }}</div>
            <div class="col-md-6 col-sm-6 col-xs-6">{{ $case->dep_ch }}</div>
        </div>
        {{ Form::close() }}
        @endforeach
    </div>
    <div class="show_box check_password_dis">
        <div class="check_password">
            <div class="sales_plz check_error_dis">
                <div class="control-label">
                    <h3>請先選擇一名工程師</h3>
                </div>
                <button type="button" class="cancel_check btn btn-info">取消</button>
            </div>
            <div class="password_plz check_success_dis">
                <div class="control-label">
                    <h3>輸入會員密碼：</h3>
                </div>
                <input type="password" class="form-control" name="password" value="">
                <button type="submit" class="final_check btn btn-info">送出</button>
                <button type="button" class="cancel_check btn btn-info">取消</button>
            </div>
        </div>
    </div>
    <div class="case_setting_foot panel-footer panel-info">
    </div>
</div>
@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
@endsection