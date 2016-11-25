<?php
$title = "結案期限通知";
?>
@extends('layouts.__sunwai_head')
@section('content')
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">結案期限通知</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">案件編號{{ $caselist[0]['case_number'] }}</span></td>
        </tr>
        <tr>
            <td style="font-size:16px;padding:20px 0 20px 40px;">已經過了結案期限了，請儘快處理，避免耽誤客戶寶貴的時間，以下為此案件的相關資訊。</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">負責人員：{{ $caselist[0]['take_user'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">支援人員：{{ $caselist[0]['extend_user'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">接案時間：{{ $caselist[0]['take_date'] }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">結案期限：{{ $caselist[0]['deadline_close'] }}</td>
        </tr>
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>
@endsection