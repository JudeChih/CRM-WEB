$(function(){
	//選取or取消選取某筆資料
	$('.case_setting_content .case_setting_detail').on('click',function(){
		if($(this).hasClass('click_select')){
			$(this).removeClass('click_select');
		}else{
			$(this).addClass('click_select');
			$(this).closest('form').siblings().find('.case_setting_detail').removeClass('click_select');
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

	// 右上角按鈕的功能
	$('[name="form_send_check"]').on('click', function () {
		$('.show_box').removeClass('check_password_dis');
		if($('.case_setting_detail').hasClass('click_select')){
			$('.sales_plz').addClass('check_error_dis');
			$('.password_plz').removeClass('check_success_dis');
		}else{
			$('.password_plz').addClass('check_success_dis');
			$('.sales_plz').removeClass('check_error_dis');
		}
  });

  // 小視窗的按鈕 功能:發送表單
  $('.final_check').on('click', function () {
  	var pw = $(this).siblings("input[name='password']").val();
  	console.log(pw);
  	$(".click_select").parent('form').find("input[name='password']").val(pw)
    $(".click_select").parent('form').submit();
  });
})