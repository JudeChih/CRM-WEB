$(function () {

    // bootstrap tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // 監聽select變換
    $('#pg_id').change(function () {
        var productgroup_selected = $(this).find(":selected").val();

        createProductOption(productgroup_selected);

    })

    window.onload = function(){
        var xx = $('html').height();
        parent.postMessage([{'height':xx}], 'http://192.168.30.102/');
    }

    // 表單驗證
    $('form').submit(function () {
        var isFormValid = true;
        $(this).find('input,select,textarea').each(function () {
            var $this = $(this);
            // 使用 trim 把空白去除
            if ($.trim($this.val()).length === 0) {
                if ($this.attr("type") == "file") {
                } else if ($(this).attr('id') == 'pd_id') {
                } else {
                    $this.tooltip('show').closest('div').addClass('error');
                    isFormValid = false;
                }
            } else if ($this.val() == 0) {
                $this.tooltip('show').closest('div').addClass('error');
                isFormValid = false;
            }
        });
        if(isFormValid == false){
            var bb = $('.error').eq(0).offset().top;
            window.parent.$('html,body').animate({'scrollTop': bb}, 1000);
            return isFormValid;
        }
        if(isFormValid == false){
            var bb = $('.error').eq(0).offset().top;
            parent.postMessage([{'scrollTop':bb}], 'http://192.168.30.102/');
            // window.parent.$('html,body').animate({'scrollTop': bb}, 1000);
            return isFormValid;
        }
        return isFormValid;
    });

    $('.j_form').find('input,select,textarea').hover(
            function () {
                var $this = $(this);
                if ($this.attr('type') == "file") {
                    $this.closest('div').removeClass('error');
                    $this.siblings('label').addClass('hover');
                } else {
                    if ($this.val() == '' || $this.val() == 0) {
                        // $this.tooltip('show');
                        $this.tooltip('destroy');
                    } else {
                        $this.tooltip('destroy');
                    }
                    $this.siblings('label').addClass('hover');
                    $this.closest('div').removeClass('error');
                }
            }, function () {
        var $this = $(this);
        if ($this.attr('type') == "file") {
            $this.siblings('label').removeClass('hover');
            $this.closest('div').removeClass('error');
            $this.tooltip('destroy');
        } else {
            $this.siblings('label').removeClass('hover');
            $this.closest('div').removeClass('error');
        }
    });

    /**
     * 建立「產品名稱」下拉選單
     * @param {type} productgroup_selected
     * @returns {undefined}
     */
    function createProductOption(productgroup_selected) {
        //取得存在「SessionStorage」的資料，並轉為〔JSON〕
        var productdata = JSON.parse(window.sessionStorage["productdata"]);
        //使用「Filter」篩選資料
        var product = $(productdata).filter(function (i, n) {
            return n.pg_id === productgroup_selected
        });
        //清空 下拉選單
        $("#pd_id option").remove();
        //顯示預設值
        if (product.length === 0) {
            $("#pd_id").append($("<option>請選擇產品分類</option>"));
        } else {
            $("#pd_id").append($("<option>請選擇產品名稱</option>"));
        }

        //迴圈 建立「下拉選單」
        $.each(product, function () {
            $("#pd_id").append($("<option></option>").attr("value", this.pd_id).text(this.pd_name));
        });
    }
})