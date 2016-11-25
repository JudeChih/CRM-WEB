<?php
$title = "申請試用表";
?>
@extends('layouts.__sunwai_head')
@section('content')
<script type="text/javascript" src="/js/apply_test_style.js"></script>
<div class="j_form_style col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
    <div class="j_title col-md-12 col-sm-12 col-xs-12">
        <h1 class="text-center">申請試用</h1>
    </div>
    <form role="form" name="applytestForm" id="applytestForm" action="/applytest/applyfortest" class="j_form col-md-12 col-sm-12 col-xs-12" method="POST" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h3 class="text-center">聯絡資訊</h3>
            <div class="form-group col-md-12">
                <label for="contact_name" class="control-label control-label">&nbsp;&nbsp;聯絡人&nbsp;&nbsp;</label>
                <input type="text" class="form-control" id="contact_name"  name="contact_name" value="" data-toggle="tooltip" title="請輸入聯絡人">
            </div>
            <div class="form-group col-md-12">
                <label for="contact_mail" class="control-label">電子郵件</label>
                <input type="email" class="form-control" id="contact_mail"  name="contact_mail" value="" data-toggle="tooltip" title="請輸入電子郵件">
            </div>
            <div class="form-group col-md-12">
                <label for="contact_phone" class="control-label">聯絡電話</label>
                <input type="text" class="form-control" id="contact_phone"  name="contact_phone" value="" data-toggle="tooltip" title="請輸入聯絡電話">
            </div>
            <div class="form-group col-md-12">
                <label for="comp_name" class="control-label">公司名稱</label>
                <input type="text" class="form-control" id="comp_name"  name="comp_name" value="" data-toggle="tooltip" title="請輸入公司名稱">
            </div>
            <div class="form-group col-md-12">
                <label for="computer_amount" class="control-label">電腦數量</label>
                <input type="number" class="form-control" id="computer_amount"  name="computer_amount" value="" data-toggle="tooltip" title="請輸入電腦數量" min="0">
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <h3 class="text-center">產品細節</h3>
            <div class="form-group col-md-12">
                <label for="pg_id" class="">產品分類</label>
                <select class="form-control" id="pg_id" name="pg_id" data-toggle="tooltip" title="請選擇產品分類">
                    <option value="0">請選擇</option>
                    @foreach ($grouplist as $pro_k => $pro_v)
                    <option value="{{ $pro_k }}">{{ $pro_v }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-12 dis_style">
                <label for="pd_id" class="">產品名稱</label>
                <select class="form-control" id="pd_id" name="pd_id" data-toggle="tooltip" title="請選擇產品名稱">
                </select>
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 btn_p_r_b">
            <button type="submit" class="btn pull-right">送出</button>
        </div>
    </form>
</div>
<div id="des" class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
    <div class="col-md-12">

    </div>
</div>
@endsection




