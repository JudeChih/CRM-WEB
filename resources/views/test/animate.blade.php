<?php
$title = "測試郵件";
?>
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
<script type="text/javascript">
    function resizeCrossDomainIframe(id, other_domain) {
        var iframe = document.getElementById(id);
        window.addEventListener('message', function (event) {
            if (event.data[0]['height'] != undefined) {
                var height = (event.data[0]['height']) + 32; // add some extra height to avoid scrollbar
                iframe.height = height + "px";
            } else if (event.data[0]['scrollTop'] != undefined) {

                secondPageValue = parseInt(event.data[0]['scrollTop']);
                $('html,body').animate({'scrollTop': secondPageValue}, 1000);

            } else if (event.data[0]['s_height'] != undefined) {
                var s_height = (event.data[0]['s_height']) + 32;

                iframe.height = s_height + "px";
            }
        }, false);
    }
</script>
<iframe src="http://localhost:8081/support/supportservice" width="100%"  border="0" frameborder="0" scrolling="no" id="my_iframe" onload="resizeCrossDomainIframe('my_iframe', 'http://localhost:8000/');"></iframe>