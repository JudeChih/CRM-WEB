<?php
if($submit == "extendcase"){
    $title = "展延";
}else if($submit == "closecase"){
    $title = "結案";
}else{};
?>
@extends('layouts.__sunwai_head')
@section('content')
<script type="text/javascript" src="/js/case_extendclose_style.js"></script>
<div class="case_setting_content col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 panel panel-info p_l_r_dis">
    <div class="panel-heading">
        <div class="case_setting_title">
            <?php if($submit == "extendcase"){ ?>
            <h1 class="text-center">展延表</h1>
            <?php }else if($submit == "closecase"){ ?>
            <h1 class="text-center">結案表</h1>
            <?php }; ?>
        </div>
    </div>
    <?php if($submit == "extendcase"){ ?>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\SupportCaseController@supportCaseDetail'),'class'=>'return_case_detail position_ab']) }}
        {{ Form::hidden('support_id', $casedata->support_id) }}
        {{ Form::button('返回',['type'=>'submit' ,'class'=>'btn btn-info navbar-right nav_select']) }}
        {{ Form::close() }}
        <form role="form" name="extendForm" id="extendForm" action="待訂" class="col-md-12 col-sm-12 col-xs-12" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="case_number" class="control-label">案件編號</label>
                <input type="text" class="form-control" id="case_number"  name="case_number" value="{{ $casedata->case_number }}" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="comp_name" class="control-label">公司名稱</label>
                <input type="text" class="form-control" id="comp_name"  name="comp_name" value="{{ $casedata->comp_name }}" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="support_subject" class="control-label">案件標題</label>
                <input type="text" class="form-control" id="support_subject"  name="support_subject" value="{{ $casedata->support_subject }}" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="extend_user" class="control-label">展延人</label>
                <input type="text" class="form-control" id="extend_user"  name="extend_user" value="" data-toggle="tooltip" title="請填寫展延人">
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="extend_date" class="control-label">展延日期</label>
                <input type="text" class="form-control" id="extend_date"  name="extend_date" value="" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="extend_reason" class="control-label">展延原因</label>
                <textarea type="text" class="form-control" rows="5" id="extend_reason"  name="extend_reason" data-toggle="tooltip" title="請說明你的展延原因" value=""></textarea>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="extend_expect_date" class="">展延預計完成日</label>
                <input type="text" name="extend_expect_date" id="extend_expect_date" class="form-control form_date" title="請填寫預計完成日">
            </div>
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 btn_p_r_b">
                {{ Form::button('確認',['name' => 'form_send_check' ,'class'=>'btn btn-info nav_select pull-right']) }}
            </div>
            <div class="show_box check_password_dis">
                <div class="check_password">
                    <div class="sales_plz check_error_dis">
                        <div class="control-label">
                            <h3>請先選擇一名業務員</h3>
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
        </form>
    </div>
    <?php }else if($submit == "closecase"){ ?>
    <div class="panel-body">
        {{ Form::open(['action' => array('ViewControllers\SupportCaseController@supportCaseDetail'),'class'=>'return_case_detail position_ab']) }}
        {{ Form::hidden('support_id', $casedata->support_id) }}
        {{ Form::button('返回',['type'=>'submit' ,'class'=>'btn btn-info navbar-right nav_select']) }}
        {{ Form::close() }}
        <form role="form" name="closeForm" id="closeForm" action="待訂" class=" col-md-12 col-sm-12 col-xs-12" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="case_number" class="control-label">案件編號</label>
                <input type="text" class="form-control" id="case_number"  name="case_number" value="{{ $casedata->case_number }}" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="comp_name" class="control-label">公司名稱</label>
                <input type="text" class="form-control" id="comp_name"  name="comp_name" value="{{ $casedata->comp_name }}" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="support_subject" class="control-label">案件標題</label>
                <input type="text" class="form-control" id="support_subject"  name="support_subject" value="{{ $casedata->support_subject }}" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="close_date" class="control-label">結案日期</label>
                <input type="text" class="form-control" id="close_date"  name="close_date" value="" disabled>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="close_description" class="control-label">結案描述</label>
                <textarea type="text" class="form-control" rows="5" id="close_description"  name="close_description" data-toggle="tooltip" title="在此填寫結案描述" value=""></textarea>
            </div>
            <div class="form-group col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                <label for="close_filename" class="">上傳結案檔案</label>
                <input type="file" name="close_filename" id="close_filename" class="form-control" title="檔案不符合規定">
                <p class="help-block">檔案大小上限20M，只能上傳tar.gz, .rar, .zip格式的檔案</p>
            </div>
            <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 btn_p_r_b">
                {{ Form::button('確認',['name' => 'form_send_check' ,'class'=>'btn btn-info nav_select pull-right']) }}
            </div>
            <div class="show_box check_password_dis">
                <div class="check_password">
                    <div class="sales_plz check_error_dis">
                        <div class="control-label">
                            <h3>請先選擇一名業務員</h3>
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
        </form>
    </div>
    <?php };?>
    <div class="case_setting_foot panel-footer panel-info">

    </div>
</div>
@endsection
