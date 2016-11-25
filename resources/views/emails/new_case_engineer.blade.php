<?php
$title = "新案件通知";
?>
@extends('layouts.__sunwai_head')
@section('content')

<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">新案件通知</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">編號{{ $caselist[0]['support_id'] }}工程師</span></td>
        </tr>
        <tr>
            <td style="font-size:16px;padding:20px 0 20px 40px;">你被委派了一件案件，以下是客戶的相關資料，請務必在時間內完成。</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">公司名稱：{{ $caselist[0]['comp_name'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品類別：{{ $caselist[0]['pg_id'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品代碼：{{ $caselist[0]['pd_id'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品版本：{{ $caselist[0]['product_version'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">案件類別：{{ $caselist[0]['problem_parent'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">細項分類：{{ $caselist[0]['problem_id'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">案件主旨：{{ $caselist[0]['support_subject'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">問題描述：{{ $caselist[0]['support_description'] }}</td>
        </tr>
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>

@endsection