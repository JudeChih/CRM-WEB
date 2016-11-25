$(function(){
	// bootstrap tooltip
	$('[data-toggle="tooltip"]').tooltip();

	// 監聽select變換
	$('#pg_id').change(function(){
		var token = $("input[name='_token']").val();
		var aa = $("#pg_id option:selected").val();
		console.log(aa);
		$.post({
			url: '/applytest/select',
			data: {_token: token,pg_id: aa},
			success: function(data){
				// 移除先前所有的option
				$('#pd_id option').remove();
				for(var k in data){
					$('#pd_id').append("<option value='"+ k +"'>"+data[k]+"</option>");
				}
					//如果子分類沒有選項就禁止點選
				if($('#pd_id option').length ==0){
					$('#pd_id').parent('div').addClass('dis_style');
					$('#pd_id').attr("disabled",true);
				}else{
					$('#pd_id').parent('div').removeClass('dis_style');
					$('#pd_id').attr("disabled",false);
				}
				console.log(data);
			},
			error: function(){
				console.log('error');
			}
		})
	})

	// 表單驗證
	$('form').submit(function(){
    var isFormValid = true;
    $(this).find('input,select,textarea').each(function(){
      var $this = $(this);
      // 使用 trim 把空白去除
      if ($.trim($this.val()).length === 0){
      	if ($this.attr("type") == "file"){
      	}else if($(this).attr('id')=='pd_id'){
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
					var f = document.supportserviceForm;
					var re = /\.(tar.gz|rar|zip)$/i;	//允許的副檔名
					var name = file.name;		//name=檔案名稱
					var size = file.size;		//size=檔案大小

					if(isCheckFileSize && size > FileSizeLimit) {
						$this.tooltip('show').closest('div').addClass('error');;
						$this.val('');  //將檔案欄設為空白
						isFormValid = false;
					}else if(isCheckFileType && !re.test(f.support_filename.value)) {
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
    return isFormValid;
	});

	$('.j_form').find('input,select,textarea').hover(
		function(){
			var $this = $(this);
			if($this.attr('type') == "file"){
				$this.closest('div').removeClass('error');
				$this.siblings('label').addClass('hover');
			}else{
				if($this.val() == '' || $this.val() == 0){
					// $this.tooltip('show');
					$this.tooltip('destroy');
				}else{
					$this.tooltip('destroy');
				}
				$this.siblings('label').addClass('hover');
				$this.closest('div').removeClass('error');
			}
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

	//如果子分類沒有選項就禁止點選
	if($('#pd_id option').length ==0){
		$('#pd_id').attr("disabled",true);
	}else{
		$('#pd_id').attr("disabled",false);
	}

})