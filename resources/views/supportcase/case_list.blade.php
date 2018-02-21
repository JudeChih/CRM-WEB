<?php
$title = "支援服務列表";
?>
@extends('layouts.__sunwai_head')
@section('content')
@inject('presenter','\App\Presenters\CaseListPresenter')

<script type="text/javascript" src="/js/case_list_style.js"></script>
<div class="case_setting_content col-md-10 col-sm-12 col-xs-12 col-md-offset-1 panel panel-info p_l_r_dis">
    <div class="panel-heading">
        <div class="case_setting_title">
            <h1>支援服務列表</h1>
        </div>
    </div>
    <div class="panel-heading">
        <div class="case_setting_title">
            <div class="row form-inline">
                {{ Form::open(['action' => array('ViewControllers\SupportCase\SupportCaseListController@supportCaseListQuery'),'method'=>'post']) }}
                {{ Form::hidden('actiontype', 'search') }}

                <!--{!! 'old：'.old('query_case_status').'<br>' !!}-->

                <div class="form-group">
                    {{ Form::label('query_case_status','案件類別') }}
                    <!--{!! Form::select('query_case_status' ,$presenter->showQuerySelectData(),['value'=>old('query_case_status')]) !!}-->
                    <select id="query_case_status" name="query_case_status" class="form-control">
                        <!--{!! $presenter->showQuerySelectOption(old('query_case_status')) !!}-->
                        {!! $presenter->showQuerySelectOption($query_case_status) !!}
                    </select>
                </div>
                <div class="form-group">
                    {{ Form::label('query_comp_name','公司名稱') }}
                    <!--{{ Form::text('query_comp_name' , old('query_comp_name') ,['class'=>'form-control']) }}-->
                    {{ Form::text('query_comp_name' , $query_comp_name ,['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('query_contact_email','聯絡人E-Mail') }}
                    <!--{{ Form::text('query_contact_email' , old('query_contact_email') ,['class'=>'form-control']) }}-->
                    {{ Form::text('query_contact_email' , $query_contact_email ,['class'=>'form-control']) }}
                </div>
                {{ Form::button('查詢',['name' => 'submit','type'=>'submit' ,'class'=>'btn btn-info' ,'value'=>'search']) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="panel-body">
        <div class="col-md-12 col-sm-12 col-xs-12 case_setting_ex">
            <form name="sort_form" action="/supportcase/caselist" method="get">
                @if(isset($sort))
                    <input type="hidden" name="sort" value="{{ $sort }}">
                    <input type="hidden" name="order" value="{{ $order }}">
                @else
                    <input type="hidden" name="sort" value="">
                    <input type="hidden" name="order" value="desc">
                @endif
                @if(isset($condition))
                    <input type="hidden" name="condition" value="{{ $condition }}">
                @endif
                @if(isset($query_case_status))
                    <input type="hidden" name="query_case_status" value="{{ $query_case_status }}">
                @endif
            </form>
            <div class="sort_check col-md-2 col-sm-2 col-xs-2 text-left" data-val="support_id">案件編號 <i class="fa fa-arrow-up" aria-hidden="true"></i>
            </div>
            <div class="col-md-1 col-sm-1 col-xs-1 text-left">案件狀態</div>
            <div class="col-md-2 col-sm-2 col-xs-2 text-left">公司名稱</div>
            <div class="col-md-1 col-sm-1 col-xs-1 text-left">聯絡人</div>
            <div class="col-md-2 col-sm-2 col-xs-2 text-left">聯絡人郵件</div>
            <div class="col-md-2 col-sm-2 col-xs-2 text-left">產品分類</div>
            <div class="col-md-2 col-sm-2 col-xs-2 text-left">產品名稱</div>
        </div>
        @foreach ($caselist as $case)
        {{ Form::open(['action' => array('ViewControllers\SupportCase\SupportCaseDetailController@supportCaseDetail'),'id'=> 'form'.$case->support_id]) }}
        {{ Form::hidden('support_id', $case->support_id) }}
        {!! $presenter->showData( $case->support_id ) !!}
        {{ Form::close() }}
        @endforeach
    </div>
    <div class="panel-footer panel-info case_setting_foot">
        @if(isset($sort))
            {{ $caselist->appends(['sort' => $sort,'order' => $order]) }}
        @else
            {{ $caselist }}
        @endif
    </div>
    @if($errors->any())
    <h4>{{$errors->first()}}</h4>
    @endif
</div>
@endsection