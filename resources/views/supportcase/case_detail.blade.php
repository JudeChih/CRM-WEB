<?php
$title = "客戶資料";
?>
@extends('layouts.__sunwai_head')
@section('content')
<script type="text/javascript" src="/js/case_detail_style.js"></script>
<div class="case_setting_content col-md-10 col-sm-12 col-xs-12 col-md-offset-1 panel panel-info p_l_r_dis">
    <div class="col-md-12 col-sm-12 col-xs-12 panel-heading">
        <div class="col-md-12 col-sm-12 col-xs-12 case_detail_title">
            <h2>案件編號：{{ $casedata->case_number }}</h2>
            <var>{{ $casedata->create_date }}</var>
        </div>
    </div>
    <div class="panel-body m_b col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>公司名稱：<span>{{ $casedata->comp_name }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>　聯絡人：<span>{{ $casedata->contact_name }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>電子郵件：<span>{{ $casedata->contact_mail }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>聯絡電話：<span>{{ $casedata->contact_phone }}</span></h3></div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>產品分類：<span>{{ $casedata->pg_id }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>產品代碼：<span>{{ $casedata->pd_id }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>產品版本：<span>{{ $casedata->product_version }}</span></h3></div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>案件類別：<span>{{ $casedata->problem_parent }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>細項分類：<span>{{ $casedata->problem_id }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>案件主旨：<span>{{ $casedata->support_subject }}</span></h3></div>
            <div class="col-md-12 col-sm-12 col-xs-12"><h3>問題描述：</h3><textarea class="form-control" rows="5" disabled>{{ $casedata->support_description }}</textarea></div>
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12 btn_box case_setting_foot panel-footer panel-info">
        {{ Form::open(['action' => array('ViewControllers\SupportCaseController@supportCaseDetailAction')]) }}
        {{ Form::hidden('support_id', $casedata->support_id) }}
        @if($auth == "manager")
            <label class="btn btn-info">連結客戶資料
                <input type="submit" name="submit" value="customer">
            </label>
            <label class="btn btn-info">設定負責業務
                <input type="submit" name="submit" value="sales">
            </label>
            <label class="btn btn-info">設定接案工程師
                <input type="submit" name="submit" value="takeengineer">
            </label>
            <label class="btn btn-info">設定支援工程師
                <input type="submit" name="submit" value="supportengineer">
            </label>
            <button  class="btn btn-info" type="button" data-name="takecase">接案</button>
            <label class="btn btn-info">展延
                <input type="submit" name="submit" value="extendcase">
            </label>
            <label class="btn btn-info">結案
                <input type="submit" name="submit" value="closecase">
            </label>
            <div class="wrap check_case_dis">
                <div class="check_case">
                    <div class="control-label">
                        <h3>輸入會員密碼：<span></span></h3>
                    </div>
                    <input type="password" class="form-control" name="password" value="">
                    <label class="btn btn-info check_case_dis">確認
                        <input type="submit" class="final_check" name="submit" value="takecase">
                    </label>
                </div>
            </div>
        @elseif($auth == "engineermanager")
            <label class="btn btn-info">連結客戶資料
                <input type="submit" name="submit" value="customer">
            </label>
            <label class="btn btn-info">設定負責業務
                <input type="submit" name="submit" value="sales">
            </label>
            <label class="btn btn-info">設定接案工程師
                <input type="submit" name="submit" value="takeengineer">
            </label>
            <label class="btn btn-info">設定支援工程師
                <input type="submit" name="submit" value="supportengineer">
            </label>
            <button  class="btn btn-info" type="button" data-name="takecase">接案</button>
            <label class="btn btn-info">展延
                <input type="submit" name="submit" value="extendcase">
            </label>
            <label class="btn btn-info">結案
                <input type="submit" name="submit" value="closecase">
            </label>
            <div class="wrap check_case_dis">
                <div class="check_case">
                    <div class="control-label">
                        <h3>輸入會員密碼：<span></span></h3>
                    </div>
                    <input type="password" class="form-control" name="password" value="">
                    <label class="btn btn-info check_case_dis">確認
                        <input type="submit" class="final_check" name="submit" value="takecase">
                    </label>
                </div>
            </div>
        @elseif($auth == "engineer")
            <label class="btn btn-info">連結客戶資料
                <input type="submit" name="submit" value="customer">
            </label>
            <label class="btn btn-info">設定負責業務
                <input type="submit" name="submit" value="sales">
            </label>
            <button  class="btn btn-info" type="button" data-name="takecase">接案</button>
            <label class="btn btn-info">展延
                <input type="submit" name="submit" value="extendcase">
            </label>
            <label class="btn btn-info">結案
                <input type="submit" name="submit" value="closecase">
            </label>
            <div class="wrap check_case_dis">
                <div class="check_case">
                    <div class="control-label">
                        <h3>輸入會員密碼：<span></span></h3>
                    </div>
                    <input type="password" class="form-control" name="password" value="">
                    <label class="btn btn-info check_case_dis">確認
                        <input type="submit" class="final_check" name="submit" value="takecase">
                    </label>
                </div>
            </div>
        @elseif($auth == "sales")
            <label class="btn btn-info">連結客戶資料
                <input type="submit" name="submit" value="customer">
            </label>
        @elseif($auth == "cs")
            <label class="btn btn-info">連結客戶資料
                <input type="submit" name="submit" value="customer">
            </label>
            <label class="btn btn-info">設定負責業務
                <input type="submit" name="submit" value="sales">
            </label>
            <label class="btn btn-info">設定接案工程師
                <input type="submit" name="submit" value="takeengineer">
            </label>
            <label class="btn btn-info">設定支援工程師
                <input type="submit" name="submit" value="supportengineer">
            </label>
            <label class="btn btn-info">展延
                <input type="submit" name="submit" value="extendcase">
            </label>
            <label class="btn btn-info">結案
                <input type="submit" name="submit" value="closecase">
            </label>
        @else
        @endif
    </div>
</div>

@if($errors->any())
<h4>{{$errors->first()}}</h4>
@endif
@if( isset($success))
<h4>{{ $success }}</h4>
@endif


@endsection