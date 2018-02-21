$(function(){
	// checkbox被選取與否
	$('.case_setting_content .case_setting_detail').on('click',function(){
		if($(this).find('.btn_select').prop("checked")){
			$(this).find('.btn_select').prop("checked", false);
		}else{
			$(this).find('.btn_select').prop("checked", true);
			$(this).parent('form').siblings().find('.btn_select').prop("checked", false);
		}
	});
	$('.case_setting_content .case_setting_detail').find('.btn_select').on('click',function(){
		if($(this).prop("checked")){
			$(this).prop("checked", false);
		}else{
			$(this).prop("checked", true);
			$(this).parent('form').siblings().find('.btn_select').prop("checked", false);
		}
	});

	// 送出時判斷是否有checkbox被選取
	$('.send').on('click',function(){
		$("input.btn_select:checked").parents('form').submit();
	});



  // 查詢排列方式顯示不同的圖示
  if($('form[name="sort_form"]').find('input[name="order"]').val() == 'asc'){
  	$('.sort_check').find('i').removeClass('fa-arrow-down');
    $('.sort_check').find('i').addClass('fa-arrow-up');
  }else if($('form[name="sort_form"]').find('input[name="order"]').val() == 'desc'){
  	$('.sort_check').find('i').removeClass('fa-arrow-up');
  	$('.sort_check').find('i').addClass('fa-arrow-down');
    
  }

	$('.sort_check').on('click',function(){
    var aa = $(this).data('val');
    var bb = $('form[name="sort_form"]').find('input[name="sort"]').val();
    var cc = $('form[name="sort_form"]').find('input[name="order"]').val();
    if(aa==bb && cc=='desc'){
      $('form[name="sort_form"]').find('input[name="order"]').val('asc');
    }else if(aa==bb && cc=='asc'){
      $('form[name="sort_form"]').find('input[name="order"]').val('desc');
    }else{
      $('form[name="sort_form"]').find('input[name="sort"]').val(aa);
      $('form[name="sort_form"]').find('input[name="order"]').val('desc');
    }
    $('form[name="sort_form"]').submit();
  })
})