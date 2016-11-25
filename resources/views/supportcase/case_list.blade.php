<?php
$title = "支援服務列表";
?>
@extends('layouts.__sunwai_head')
@section('content')
<script type="text/javascript" src="/js/case_list_style.js"></script>
<div class="case_setting_content col-md-10 col-sm-12 col-xs-12 col-md-offset-1 panel panel-info p_l_r_dis">
    <div class="panel-heading">
        <div class="case_setting_title">
            <h1>支援服務列表</h1>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-md-12 col-sm-12 col-xs-12 case_setting_ex">
            <div class="col-md-3 col-sm-3 col-xs-3">案件編號</div>
            <div class="col-md-3 col-sm-3 col-xs-3">公司名稱</div>
            <div class="col-md-2 col-sm-2 col-xs-2">聯絡人</div>
            <div class="col-md-2 col-sm-2 col-xs-2">產品分類</div>
            <div class="col-md-2 col-sm-2 col-xs-2">產品代碼</div>
        </div>
        @foreach ($caselist as $case)
        {{ Form::open(['action' => array('ViewControllers\SupportCaseController@supportCaseDetail'),'id'=> 'form'.$case->case_number]) }}
        <a href="#" class="case_setting_detail col-md-12 col-sm-12 col-xs-12" onclick="{{ 'form'.$case->case_number }}.submit();">
            {{ Form::hidden('support_id', $case->support_id) }}
            <div class="col-md-3 col-sm-3 col-xs-3">{{ $case->case_number }}</div>
            <div class="col-md-3 col-sm-3 col-xs-3">{{ $case->comp_name }}</div>
            <div class="col-md-2 col-sm-2 col-xs-2">{{ $case->contact_name }}</div>
            <div class="col-md-2 col-sm-2 col-xs-2">{{ $case->pg_id }}</div>
            <div class="col-md-2 col-sm-2 col-xs-2">{{ $case->pd_id }}</div>
        </a>
        {{ Form::close() }}
        @endforeach
    </div>
    <div class="panel-footer panel-info case_setting_foot">
        {{ $caselist }}
    </div>
</div>
@endsection