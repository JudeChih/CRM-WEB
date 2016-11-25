$(function(){
	$('.case_setting_foot button').on('click',function(){
		$('.wrap').removeClass('check_case_dis');
		$(".check_case label").addClass('check_case_dis');
		var btn_name = $(this).data('name');
		console.log(btn_name);
		$(".check_case label input[value='"+btn_name+"']").parent('label').removeClass('check_case_dis');
	});
	$(document).mouseup(function(e){
	  var _con1 = $('.check_case');
	  if(!_con1.is(e.target) && _con1.has(e.target).length === 0){
	    $('.wrap').addClass('check_case_dis');
	    $('.check_case').find('span').text('');
	  }
	});
})