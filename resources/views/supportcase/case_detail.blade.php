<?php
$title = "客戶資料";
?>
@extends('layouts.__sunwai_head')
@section('content')
@inject('presenter','\App\Presenters\CaseDetailPresenter')

<script type="text/javascript" src="/js/case_detail_style.js"></script>

<div class="case_setting_content col-md-10 col-sm-12 col-xs-12 col-md-offset-1 panel panel-info p_l_r_dis">
    <div class="col-md-12 col-sm-12 col-xs-12 panel-heading">
        <div class="col-md-12 col-sm-12 col-xs-12 case_detail_title">
            <h2>案件編號：{{ $casedata->case_number }}</h2>
            <var>建立日期：{{ $casedata->create_date }}</var><br>
            <var>案件狀態：{{ $presenter ->showCaseStatus( $casedata->case_status ) }}</var>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 case_detail_title">

            {{ Form::open(['action' => array('ViewControllers\SupportCase\SupportCaseListController@supportCaseList')]) }}
            {{ Form::submit('返回',['name' => 'back' ,'class'=>'btn btn-info navbar-right nav_select']) }} 
            {{ Form::close() }}


        </div>
    </div>
    <div class="panel-body m_b col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>公司名稱：<span>{{ $casedata->comp_name }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>對應CRM客戶：<span>{{ isset($casedata->customerData) ? $casedata->customerData->cd_full_cname : '' }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>　聯絡人：<span>{{ $casedata->contact_name }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>電子郵件：<span>{{ $casedata->contact_mail }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>聯絡電話：<span>{{ $casedata->contact_phone }}</span></h3></div>

            <div class="col-md-12 col-sm-12 col-xs-12"><h3>接案工程師：<span>{{ $casedata->takeCaseEnginnerName() }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>接案日期：<span>{{ $casedata->takeCaseTime() }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>支援工程師：<span>{{ $casedata->supportCaseEnginnerName() }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>負責業務：<span>{{ $casedata->salesName() }}</span></h3></div>

        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">

            <div class="col-md-12 col-sm-12 col-xs-12"><h3>產品分類：<span>{{ isset($casedata->productGroup) ? $casedata->productGroup->pg_name : '' }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>產品代碼：<span>{{ isset($casedata->productData) ? $casedata->productData->pd_name : '' }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>產品版本：<span>{{ $casedata->product_version }}</span></h3></div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>案件類別：<span>{{ isset($casedata->problemCategory) ? $casedata->problemCategory->problem_name : '' }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>細項分類：<span>{{ isset($casedata->subProblemCategory) ? $casedata->subProblemCategory->problem_name : '' }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>案件主旨：<span>{{ $casedata->support_subject }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>問題描述：</h3><textarea class="form-control" rows="5" disabled>{{ $casedata->support_description }}</textarea></div>
            @if($casedata->support_filename != null)
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>上傳的檔案：<a class="btn btn-info btn-xs" href="{{ '../files/newsupportcasefiles/'.$casedata->support_filename }}" target="_blank" >點擊下載</a></h3></div>
            @endif
        </div>
        @if($casedata->case_status == '2' || $casedata->case_status == '3' || $casedata->case_status == '4')
        {!! $presenter ->showCaseStatusDetails( $casedata->support_id ) !!}
        @endif
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 btn_box case_setting_foot panel-footer panel-info">

        {{ Form::open(['action' => array('ViewControllers\SupportCase\SupportCaseDetailController@supportCaseDetail')]) }}
        {{ Form::hidden('support_id', $casedata->support_id) }}

        {!! $presenter ->checkCaseStatus( $casedata->case_status ) !!}
        <div class="wrap check_case_dis">
            <div class="check_case">
                <div class="control-label">
                    <h3>輸入會員密碼：<span></span></h3>
                </div>
                <input type="password" class="form-control" name="password" value="">
                <label class="btn btn-info">確認
                    <input type="submit" class="final_check" name="submit" value="takecase">
                </label>
            </div>
        </div>
        {{ Form::close() }}


    </div>
</div>

@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif

@if( isset($success))
<h4>{{ $success }}</h4>
@endif


@endsection