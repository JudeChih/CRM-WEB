<?php
$title = "技術支援服務";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="_token" content="{{ csrf_token() }}"/>
        <title>{{ isset($title) ? $title.' | ' : '' }}翔偉資安</title>

        <link rel="stylesheet" type="text/css" href="/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" type="text/css" href="/css/css/stylesheets/style.css">

        <script type="text/javascript" src="/js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="/js/bootstrap-datetimepicker.zh-TW.js"></script>
        <script type="text/javascript" src="/js/style.js"></script>
        <script type="text/javascript" src="/js/support_service.js"></script>
    </head>
    <body>
        @inject('presenter','\App\Presenters\SupportServicePresenter')

        <div class="j_form_style col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
            <img class="form_img" src="/images/sunwaiForm.png">
            <div class="j_title col-md-12 col-sm-12 col-xs-12">
                <h1 class="text-center">技術支援服務</h1>
            </div>
            <form role="form" name="supportserviceForm" action="/support/supportservice" class="j_form col-md-12 col-sm-12 col-xs-12" method="POST" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h3 class="text-center">聯絡資訊</h3>
                    <div class="form-group col-md-12">
                        <label for="comp_name" class="control-label">公司名稱</label>
                        <input type="text" class="form-control" id="comp_name"  name="comp_name" value="" data-toggle="tooltip" title="請填寫公司名稱">
                    </div>
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
                        <label for="contact_carboncopy" class="control-label">副本寄送</label>
                        <input type="text" class="form-control" id="contact_carboncopy"  name="contact_carboncopy" value="">
                        <p class="help-block">信箱之間請用(分號;)格開</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <h3 class="text-center">產品細節</h3>
                    <div class="form-group col-md-12">
                        <label for="pg_id" class="">產品分類</label>
                        <select class="form-control" id="pg_id" name="pg_id" data-toggle="tooltip" title="請選擇產品分類">
                            {!! $presenter ->showProductGroupOption( $productgroup ) !!}
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="pd_id" class="">產品名稱</label>
                        <select class="form-control" id="pd_id" name="pd_id" data-toggle="tooltip" title="請選擇產品名稱">
                            <option value="" selected="selected">請選擇產品分類</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="product_version" class="control-label">產品版本</label>
                        <input type="text" class="form-control" id="product_version"  name="product_version" value="" data-toggle="tooltip" title="請填寫產品版本">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <h3 class="col-md-12 col-sm-12 col-xs-12 text-center">案件細節</h3>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12 p_r">
                        <label for="problem_parent" class="control-label">案件類別</label>
                        <select class="form-control" id="problem_parent" name="problem_parent" data-toggle="tooltip" title="請選擇案件類別">
                            <option value="" selected="selected">請選擇產品分類</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12 p_l">
                        <label for="problem_id" class="control-label">細項分類</label>
                        <select class="form-control" id="problem_id" name="problem_id" data-toggle="tooltip" title="請選擇細項分類">
                            <option value="" selected="selected">請選擇案件類別</option>
                        </select>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label for="support_subject" class="control-label">案件主旨</label>
                        <input type="text" class="form-control" id="support_subject"  name="support_subject" value="" data-toggle="tooltip" title="請輸入案件主旨">
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <label for="support_description" class="control-label">問題描述</label>
                        <textarea type="text" class="form-control" rows="5" id="support_description"  name="support_description" data-toggle="tooltip" title="在此陳述您的問題" value=""></textarea>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12 p_r">
                        <label for="support_filename" class="">檔案上傳</label>
                        <input type="file" name="support_filename" id="support_filename" class="form-control" title="檔案不符合規定">
                        <p class="help-block">檔案大小上限20M，只能上傳tar.gz, .rar, .zip格式的檔案</p>
                    </div>
                    <div class="form-group col-md-6 col-sm-6 col-xs-12 p_r">
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 btn_p_r_b">
                    <div class="g-recaptcha" data-sitekey="6LcBIA4UAAAAABUUcJUa_M4vyInzKmP3eXIdcaPP" data-callback="recaptcha_callback"></div>

                    <button type="submit" id="service_submit" class="btn btn-info pull-right">送出</button>
                </div>

                @if($errors->any())
                <h4>{{$errors->first()}}</h4>
                @endif
            </form>
        </div>
        <div id="des" class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
            <div class="col-md-12">
                <h2>支援工具操作說明 :</h2>
                <p>如果您使用芬安全F-secure產品有任何問題，您可以執行支援工具並提供fsdiag檔案，以利分析。</p>
                <p>該檔案包含該台電腦的系統資訊與事件紀錄，有助於我們查詢相關紀錄、分析問題並提供解決方案。</p>
                <p>執行支援工具可能需要一些時間，請耐心等候。</p>

                <h3>for windows的操作方式 : 請以系統管理員身份(administrator)執行</h3>
                <p>執行方式 : 【開始】->【所有程式】->【F-Secure Client Security Premium】->【支援工具】</p>
                <p>會在桌面產生一個fsdiag.tar.gz的檔案</p>

                <h3>for linux的操作方式 : 請以系統管理員身份(root)執行</h3>
                <p>執行方式 : 開啟終端機 -> 輸入“sh /opt/f-secure/fspms/bin/fsdiag”</p>
                <p>會產生在執行的路徑中產生一個fsdiag.tar.gz的檔案</p>
            </div

        </div>

        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script type="text/javascript" >
        window.sessionStorage["productdata"] = JSON.stringify({!! ($productdata) !!});
        window.sessionStorage["problemcategory"] = JSON.stringify({!! ($problemcategory) !!});
        window.sessionStorage["subproblemcategory"] = JSON.stringify({!! ($subproblemcategory) !!});
        </script>

        <script type="text/javascript">
                    function recaptcha_callback() {
                        $('#service_submit').removeClass('disabled');
                    }
        </script>



    </body>
</html>
