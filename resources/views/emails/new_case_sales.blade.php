<?php
$title = "新案件通知";
?>
<table style="width:600px;margin: 0 auto;font-family:微軟正黑體; font-size:14px;">
    <thead>
        <tr>
            <th style="text-align: center;font-size:25px;padding-bottom:20px;">新案件通知</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><span style="font-size:16px;padding: 5px;background-color: #ddd;border-radius: 5px;">案件編號：{{ $casedata->case_number }}</span></td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">公司名稱：{{ $casedata->comp_name }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品類別：{{ isset($casedata->productGroup) ? $casedata->productGroup->pg_name : '' }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品名稱：{{ isset($casedata->productData) ? $casedata->productData->pd_name : '' }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">產品版本：{{ $casedata->product_version }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">案件類別：{{ isset($casedata->problemCategory) ? $casedata->problemCategory->problem_name : '' }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">細項分類：{{ isset($casedata->subProblemCategory) ? $casedata->subProblemCategory->problem_name : '' }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">案件主旨：{{ $casedata->support_subject }}</td>
        </tr>
        <tr>
            <td style="padding:5px 0 5px 40px;">問題描述：{{ $casedata->support_description }}</td>
        </tr>

        <tr>
            <td style="padding-top:40px;text-align: center;">註 : 此為系統自動發送的信件，無須回覆。</td>
        </tr>
    </tbody>
</table>
