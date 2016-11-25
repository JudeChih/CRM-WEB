$(function(){
	$('[data-toggle="tooltip"]').tooltip();
	$('.form_date').datetimepicker({
		format: 'yyyy-mm-dd',
    language:  'zh-TW',
    weekStart: 7,
    todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
  });

	function getToday(){
		// 當天日期
		var Today=new Date();
		var day = Today.getFullYear()+ "-" + (Today.getMonth()+1) + "-" + Today.getDate();
		$("#extend_date").attr('value',day);
		$("#close_date").attr('value',day);
		//設定起始時間
		$('.form_date').datetimepicker('setStartDate', day);
		};
	getToday();

	$('#extendForm,#closeForm').find('input,select,textarea').hover(
		function(){
			var $this = $(this);
			$this.tooltip('destroy');
			$this.tooltip('destroy');
			$this.siblings('label').addClass('hover');
			$this.closest('div').removeClass('error');
	},function(){
			var $this = $(this);
			if($this.attr('type') == "file"){
				$this.siblings('label').removeClass('hover');
				$this.closest('div').removeClass('error');
				$this.tooltip('destroy');
			}else{
				$this.siblings('label').removeClass('hover');
				$this.closest('div').removeClass('error');
			}
	});

	// 右下角按鈕的功能  先判斷表單是否填寫完成再跳小視窗輸入密碼
	$('[name="form_send_check"]').on('click', function () {
		var isFormValid = true;
		$('form').find('input,select,textarea').each(function(){
      var $this = $(this);
      // 使用 trim 把空白去除
      if ($.trim($this.val()).length === 0){
      	if ($this.attr("type") == "file"){
      	}else if($this.attr('name') == 'password'){

      	}else{
      		$this.tooltip('show').closest('div').addClass('error');
      		isFormValid = false;
      	}
      }else if($this.val() == 0){
      	$this.tooltip('show').closest('div').addClass('error');
        isFormValid = false;
      }else{
      	if($this.attr("type") == "file"){
      		var file = this.files[0];
					var isCheckFileType = true;  //是否檢查副檔名
					var isCheckFileSize = true;  //是否檢查檔案大小
					var FileSizeLimit = 20*1024*1024;  //上傳上限20M，單位:byte
					var f = document.closeForm;
					var re = /\.(tar.gz|rar|zip)$/i;	//允許的副檔名
					var name = file.name;		//name=檔案名稱
					var size = file.size;		//size=檔案大小

					if(isCheckFileSize && size > FileSizeLimit) {
						$this.tooltip('show').closest('div').addClass('error');;
						$this.val('');  //將檔案欄設為空白
						isFormValid = false;
					}else if(isCheckFileType && !re.test(f.close_filename.value)) {
						$this.tooltip('show').closest('div').addClass('error');;
						$this.val(''); 	//將檔案欄設為空
						isFormValid = false;
					}else{
						$this.tooltip('destroy');
					}
      	}else{
      		$this.tooltip('destroy').closest('div').removeClass('error');
      	}
      }
    });
    if(isFormValid){
    	$('.show_box').removeClass('check_password_dis');
				$('.password_plz').removeClass('check_success_dis');
    }
  });
  // 點擊目標已外的地方，目標消失
	$(document).mouseup(function(e){
	  var _con1 = $('.check_password');
	  if(!_con1.is(e.target) && _con1.has(e.target).length === 0){
	    $('.show_box').addClass('check_password_dis');
	    $('.sales_plz').addClass('check_error_dis');
	    $('.password_plz').addClass('check_success_dis');
	  }
	});
	$('.cancel_check').on('click',function(){
		$('.show_box').addClass('check_password_dis');
	})
})