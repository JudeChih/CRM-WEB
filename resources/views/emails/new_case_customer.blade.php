<?php
$title = "案件成功發送";
?>
@extends('layouts.__sunwai_head')
@section('content')
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">案件成功發送</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:16px;">親愛的<span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">{{ $caselist->content_name }}</span>您好</td>
        </tr>
        <tr>
            <td style="font-size:16px;padding:20px 0 20px 40px;">感謝您的提問，我們會盡快委派專員與您聯繫，以下是您這次提問的案件編號，請告知專員案件編號。</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">案件編號：{{ $caselist->case_number }}</td>
        </tr>
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>
@endsection