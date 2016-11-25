<?php
$title = "申請試用通知";
?>
@extends('layouts.__sunwai_head')
@section('content')
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">申請試用通知</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">客戶{{ $caselist[0]['content_name'] }}</span></td>
        </tr>
        <tr>
            <td style="font-size:16px;padding:20px 0 20px 40px;">送來一份申請試用表，請盡快安排專員與其聯繫，以下是客戶的基本資料及申請的品項。</td>
        </tr>
        
        <tr>
            <td style="padding:5px 0 5px 40px;">　聯絡人：{{ $caselist[0]['content_name'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">電子郵件：{{ $caselist[0]['content_mail'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">聯絡電話：{{ $caselist[0]['content_phone'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">公司名稱：{{ $caselist[0]['comp_name'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">電腦數量：{{ $caselist[0]['computer_amount'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品類別：{{ $caselist[0]['pg_id'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品代碼：{{ $caselist[0]['pd_id'] }}</td>
        </tr>
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>
@endsection