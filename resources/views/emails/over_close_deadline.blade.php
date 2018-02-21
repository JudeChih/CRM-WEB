<?php
$title = "結案期限通知";
?>
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">結案期限通知</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span style="font-size:16px;padding: 5px; font-weight: bold;">親愛的同仁：</span></td>
        </tr>
        <tr>
            <td style="font-size:16px;padding:20px 0 20px 40px;">以下案件編號已經過了結案期限了，請儘快處理，避免耽誤客戶寶貴的時間，以下為此案件的相關資訊。</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;font-size:14px;">案件編號列表：</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px; font-size:14px;">
                @foreach ($case_numbers as $index => $case_number)
                {{ $case_number.'、' }} 
                @if (($index+1) % 4 === 0 )
                <br>
                @endif
                @endforeach
            </td>
        </tr>

        <tr>
            <td style="padding:5px 0 5px 40px; font-size:14px;">
                {{ '共 '.count($case_numbers) .' 筆' }}
            </td>
        </tr>
        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>