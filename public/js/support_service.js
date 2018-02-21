$(function () {
    var sunwaiURL = 'http://192.168.30.102/';
    // var sunwaiURL = 'http://localhost:8082';
    // bootstrap tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('#pg_id').change(function () {
        //取得「產品分類」所選擇的值
        var productgroup_selected = $(this).find(":selected").val();

        createProductOption(productgroup_selected);
        createProblemCategory(productgroup_selected);
    });
    $('#problem_parent').change(function () {
        //取得「產品分類」所選擇的值
        var problemcategory_selected = $(this).find(":selected").val();

        createSubProblemCategory(problemcategory_selected);
    });

    $("form").submit(function (event) {

        var recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            event.preventDefault();
        }
    });
    // 點擊滑到指定地方


    window.onload = function () {
        var xx = $('html').height();
        parent.postMessage([{'height': xx}], sunwaiURL);
    }

    $('.form_img').on("click", function () {
        var aa = $('#des').offset().top;
        parent.postMessage([{'scrollTop': aa}], sunwaiURL);
    });

    // 表單驗證
    $('form').submit(function () {

        var isFormValid = true;

        $(this).find('input,select,textarea').each(function () {
            var $this = $(this);
            // 使用 trim 把空白去除
            if ($.trim($this.val()).length === 0) {
                if ($this.attr("type") == "file") {
                }else if($(this).attr('id')=='product_version' || $(this).attr('id')=='contact_carboncopy'){

                } else {
                    $this.tooltip('show').closest('div').addClass('error');
                    isFormValid = false;
                }
            } else if ($this.val() == 0) {
                $this.tooltip('show').closest('div').addClass('error');
                isFormValid = false;
            } else {
                if ($this.attr("type") == "file") {
                    var file = this.files[0];
                    var isCheckFileType = true;  //是否檢查副檔名
                    var isCheckFileSize = true;  //是否檢查檔案大小
                    var FileSizeLimit = 20 * 1024 * 1024;  //上傳上限20M，單位:byte
                    var f = document.supportserviceForm;
                    var re = /\.(tar.gz|rar|zip)$/i;	//允許的副檔名
                    var name = file.name;		//name=檔案名稱
                    var size = file.size;		//size=檔案大小

                    if (isCheckFileSize && size > FileSizeLimit) {
                        $this.tooltip('show').closest('div').addClass('error');
                        ;
                        $this.val('');  //將檔案欄設為空白
                        isFormValid = false;
                    } else if (isCheckFileType && !re.test(f.support_filename.value)) {
                        $this.tooltip('show').closest('div').addClass('error');
                        ;
                        $this.val(''); 	//將檔案欄設為空
                        isFormValid = false;
                    } else {
                        $this.tooltip('destroy');
                    }
                } else {
                    $this.tooltip('destroy').closest('div').removeClass('error');
                }
            }
        });
        if (isFormValid == false) {
            var bb = $('.error').eq(0).offset().top;
            console.log(bb);

            parent.postMessage([{'scrollTop': bb}], sunwaiURL);
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
            $("#pd_id").append($("<option value='' selected='selected'>請選擇產品分類</option>"));
        } else {
            $("#pd_id").append($("<option value='' selected='selected'>請選擇產品名稱</option>"));
        }

        //迴圈 建立「下拉選單」
        $.each(product, function () {
            $("#pd_id").append($("<option></option>").attr("value", this.pd_id).text(this.pd_name));
        });
    }
    /**
     * 建立「案件類別」下拉選單
     * @param {type} productgroup_selected
     * @returns {undefined}
     */
    function createProblemCategory(productgroup_selected) {
        //取得存在「SessionStorage」的資料，並轉為〔JSON〕
        var problemcategory = JSON.parse(window.sessionStorage["problemcategory"]);
        //使用「Filter」篩選資料
        var problem = $(problemcategory).filter(function (i, n) {
            return n.pg_id === productgroup_selected
        });
        //清空 下拉選單
        $("#problem_parent option").remove();

        //顯示預設值
        if (problem.length === 0) {
            $("#problem_parent").append($("<option value='' selected='selected'>請選擇產品分類</option>"));
        } else {
            $("#problem_parent").append($("<option value='' selected='selected'>請選擇案件類別</option>"));
        }

        //迴圈 建立「下拉選單」
        $.each(problem, function () {
            $("#problem_parent").append($("<option></option>").attr("value", this.problem_id).text(this.problem_name));
        });
    }

    /**
     * 建立「案件子類別」下拉選單
     * @param {type} productgroup_selected
     * @returns {undefined}
     */
    function createSubProblemCategory(problemcategory_selected) {
        //取得存在「SessionStorage」的資料，並轉為〔JSON〕
        var subproblemcategory = JSON.parse(window.sessionStorage["subproblemcategory"]);
        //使用「Filter」篩選資料
        var subproblem = $(subproblemcategory).filter(function (i, n) {
            return n.problem_parent === problemcategory_selected
        });
        //清空 下拉選單
        $("#problem_id option").remove();
        //顯示預設值
        if (subproblem.length === 0) {
            $("#problem_id").append($("<option value='' selected='selected'>請選擇案件類別</option>"));
        } else {
            $("#problem_id").append($("<option value='' selected='selected'>請選擇細項分類</option>"));
        }
        //迴圈 建立「下拉選單」
        $.each(subproblem, function () {
            $("#problem_id").append($("<option></option>").attr("value", this.problem_id).text(this.problem_name));
        });
    }
})

