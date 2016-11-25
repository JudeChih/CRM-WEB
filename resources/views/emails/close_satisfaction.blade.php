<?php
$title = "滿意度調查";
?>
@extends('layouts.__sunwai_head')
@section('content')
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">滿意度調查</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style="font-size:16px;">親愛的<span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">{{ $caselist[0]['content_name'] }}</span>您好</td>
        </tr>
        <tr>
            <td style="font-size:16px;padding:20px 0 20px 40px;">為了讓您與每個客戶都擁有更好的服務品質，能否佔用您寶貴的幾分鐘幫我們填一份針對這次問題處理的滿意度調查表？</td>
        </tr>
        <tr>
            <td style="padding-left:40px;"><a href="#">點擊前往給分</a></td>
        </tr>
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>
@endsection