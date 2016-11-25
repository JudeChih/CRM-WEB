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
})