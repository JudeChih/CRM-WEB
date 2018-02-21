$(function(){
	var min_y , max_y;
	var date = new Date();
	var m = date.getMonth();
	var y = date.getFullYear();
	nowDate();
	setHeight();

	// 改變每日的高度，跟寬度一致
	function setHeight(){
		var a = $('.day_group').find('div').outerWidth();
		$('.day_group').find('div').outerHeight(a);
		$('.day_group').find('span').outerHeight(a);
	}
	$(window).resize(function(){
		setHeight();
	})


	// 年月被變動的時候改變"日"的排法
	$('#c_year,#c_month').change(function(){
		$('.xxx').click();
	})

	// 刷新頁面預設為當前月
	function nowDate(){
		var yy = parseFloat($('#c_year').data('year'));
		var mm = parseFloat($('#c_month').data('month'));
		// console.log('所選年:'+yy+',所選月:'+mm);
		var firstDayOfWeek = parseFloat($('.day_group').find('div').data('dayofweek'));
		$('#c_year').append('<option value="'+y+'">'+y+'年</option>');
		$('#c_year').prepend('<option value="'+(y-1)+'">'+(y-1)+'年</option>');
		$('#c_year').append('<option value="'+(y+1)+'">'+(y+1)+'年</option>');
		$('#c_month').find('option').eq(mm-1).attr('selected',true);
		$('#c_year').find('option').each(function(){
			if($(this).val() == yy){
				$(this).attr('selected',true);
			}
		})
		var daysOfMonth = getDaysOfMonth(yy,mm);
		getDayOfWeek(firstDayOfWeek);
		spanToTheEnd(firstDayOfWeek,daysOfMonth);
	}

	// 補滿後面形成一個方型
	function spanToTheEnd(dow,dom){
		$('.day_group').append(function(){
			var j = '';
			if((dow==7&&dom==28)||(dow==6&&dom==29)||(dow==5&&dom==30)||(dow==4&&dom==31)){

			}else if((dow==1&&dom==28)||(dow==7&&dom==29)||(dow==6&&dom==30)||(dow==5&&dom==31)){
				for(var i=1;i<=6;i++){
					j = j+'<span class="col-md-1 col-sm-1 col-xs-1"></span>';
				}
			}else if((dow==2&&dom==28)||(dow==1&&dom==29)||(dow==7&&dom==30)||(dow==6&&dom==31)){
				for(var i=1;i<=5;i++){
					j = j+'<span class="col-md-1 col-sm-1 col-xs-1"></span>';
				}
			}else if((dow==3&&dom==28)||(dow==2&&dom==29)||(dow==1&&dom==30)||(dow==7&&dom==31)){
				for(var i=1;i<=4;i++){
					j = j+'<span class="col-md-1 col-sm-1 col-xs-1"></span>';
				}
			}else if((dow==4&&dom==28)||(dow==3&&dom==29)||(dow==2&&dom==30)||(dow==1&&dom==31)){
				for(var i=1;i<=3;i++){
					j = j+'<span class="col-md-1 col-sm-1 col-xs-1"></span>';
				}
			}else if((dow==5&&dom==28)||(dow==4&&dom==29)||(dow==3&&dom==30)||(dow==2&&dom==31)){
				for(var i=1;i<=2;i++){
					j = j+'<span class="col-md-1 col-sm-1 col-xs-1"></span>';
				}
			}else if((dow==6&&dom==28)||(dow==5&&dom==29)||(dow==4&&dom==30)||(dow==3&&dom==31)){
				for(var i=1;i<=1;i++){
					j = j+'<span class="col-md-1 col-sm-1 col-xs-1"></span>';
				}
			}else{

			}
			return j;
		})
	}

	// 選擇日期
	function createSelectClick(){
		$('.day_group div').on('click',function(){
			if($(this).hasClass('select_day')){
				$(this).removeClass('select_day');
			}else{
				$(this).addClass('select_day');
			}
		});
	}

	// 判斷某年某月有幾天
	function getDaysOfMonth(whichYear,whichMonth){
		// 先把輸入月份轉成0~11的格式後，月份+1
	  var mydate=new Date(whichYear,whichMonth-1,1);
	  mydate.setMonth(mydate.getMonth()+1);
	  // 把月份+1以後的放入下面日期為0的參數裡面，代表到下個月再往前推一天，也就是一個月裡有幾天
	  var myResult = new Date(mydate.getFullYear(),mydate.getMonth(),0)
	  return myResult.getDate();
	}

	// 判斷當月第一天是星期幾
	function getDayOfWeek(firstDay){
		if(firstDay == 7){

		}else{
			$('.day_group').prepend(function(){
				var j ='';
				for(var i=1;i<=firstDay;i++){
					j = j+'<span class="col-md-1 col-sm-1 col-xs-1"></span>';
				}
				return j;
			})
		}
	}

	//判斷每日的c_is_holiday值做設定
	$('.day_group input').each(function(){
		if($(this).val()==1){
			$(this).closest('div').addClass('set_holiday');
		}
	})

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

/////////////////////////////////////各式按鈕///////////////////////////////////////
	// "編輯按鈕"的功能
	$('.btn_group .edit_check').on('click',function(){
		$('.day_group').addClass('editting');
		$('.reset_check').addClass('btn_dis');
		$(this).addClass('btn_dis');
		$('.send_check,.cancel_check').removeClass('btn_dis');
		createSelectClick();
		$('#c_year,#c_month').attr('disabled',true);
		$('.btn_left,.btn_right').attr('disabled',true);
	})
	// "送出按鈕"的功能
	$('.btn_group .send_check').on('click', function () {
		$('.show_box').removeClass('check_password_dis');
  });
  // "取消按鈕"的功能
  $('.btn_group .cancel_check').on('click',function(){
  	$('.day_group div').unbind('click');
		$('.day_group div').removeClass('select_day');
		$('.day_group').removeClass('editting');
		$(this).addClass('btn_dis');
		$('.send_check').addClass('btn_dis');
		$('.reset_check').removeClass('btn_dis');
		$('.edit_check').removeClass('btn_dis');
		$('#c_year,#c_month').attr('disabled',false);
		$('.btn_left,.btn_right').attr('disabled',false);
  })
	// 當左箭頭被按到
	$('.btn_left').on('click',function(){
		var min_y = parseInt($('#c_year option:first-child').val());
		var cmvl = parseInt($('#c_month').find(':selected').val());
		var cyvl = parseInt($('#c_year').find(':selected').val());
		if(cmvl == 1 && cyvl>min_y){
			$('#c_year option').each(function(){
				if($(this).val() == cyvl-1){
					$(this).siblings('option').attr('selected',false);
					$(this).attr('selected',true);
					$('#c_month option').attr('selected',false);
					$('#c_month option').eq(11).attr('selected',true);
					$('.xxx').click();
				}
			})
		}else if(cmvl == 1 && cyvl == min_y){

		}else{
			$('#c_month option').each(function(){
				if($(this).val() == cmvl-1){
					$(this).siblings('option').attr('selected',false);
					$(this).attr('selected',true);
				}
			})
			$('.xxx').click();
		}
	})

	// 當右箭頭被按到
	$('.btn_right').on('click',function(){
		var max_y = parseInt($('#c_year option:last-child').val());
		var cmvr = parseInt($('#c_month').find(':selected').val());
		var cyvr = parseInt($('#c_year').find(':selected').val());
		if(cmvr == 12 && cyvr < max_y){
			$('#c_year option').each(function(){
				if($(this).val() == cyvr+1){
					$(this).siblings('option').attr('selected',false);
					$(this).attr('selected',true);
					$('#c_month option').attr('selected',false);
					$('#c_month option').eq(0).attr('selected',true);
					$('.xxx').click();
				}
			})
		}else if(cmvr == 12 && cyvr == max_y){

		}else{
			$('#c_month option').each(function(){
				if($(this).val() == cmvr+1){
					$(this).siblings('option').attr('selected',false);
					$(this).attr('selected',true);
				}
			})
			$('.xxx').click();
		}
	})

/////////////////////////////////////Ajax部份///////////////////////////////////////
	// 新建所選月份預設休假日
	$('.create_check').on('click',function(){
		var token = $("input[name='_token']").val();
		var y = parseFloat($('#c_year').data('year'));
		var m = parseFloat($('#c_month').data('month'));
		var howmanydays = getDaysOfMonth(y,m);
		// console.log('所選年:'+y+'，所選月:'+m+'，當月有'+howmanydays+'天');
		$.ajax({
			url: '/holiday/holiday_save',
			type:'POST',
			cache:false,
			datatype:'json',
			data: {_token: token,c_year: y,c_month: m,c_numberofday: howmanydays,submit: 'create'},
			success: function(data){
				alert('新建成功！');
				history.go(0);
			},
			error: function(){
				console.log('error');
			}
		})
	})

	// 重設當月休假日設定
	$('.reset_check').on('click',function(){
		var token = $("input[name='_token']").val();
		var a = [];
		var y = parseFloat($('#c_year').data('year'));
		var m = parseFloat($('#c_month').data('month'));
		var pw = $('input[name="password"]').val();
		$('form[name="holiday_form"]').find('input').each(function(){
			if($(this).attr('type') == 'text'){
				var p = {};
				p[$(this).attr('name')] = $(this).parent('.input_area').data('dayofweek');
				a.push(p);
			}
		})
		$.ajax({
			url: '/holiday/holiday_save',
			type:'POST',
			cache:false,
			datatype:'json',
			data: {_token: token,c_year: y,c_month: m,c_dayofweek: a,submit: 'reset'},
			beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
			success: function(data){
				if(data == '密碼錯誤，請重新輸入'){
					alert(data);
					history.go(0);
				}else{
					alert('重置成功！');
					history.go(0);
				}
			},
			error: function(){
				console.log('error');
			}
		})
	})

	// 當月表單編輯完送出
	$('.final_check').on('click',function(){
		var token = $("input[name='_token']").val();
		var a = [];
		var y = parseFloat($('#c_year').data('year'));
		var m = parseFloat($('#c_month').data('month'));
		var pw = $('input[name="password"]').val();
		$('form[name="holiday_form"]').find('input').each(function(){
			if($(this).parent('.input_area').hasClass('select_day')){
				if($(this).parent('.input_area').hasClass('set_holiday')){
					$(this).val('0');
				}else{
					$(this).val('1');
				}
			}
			if($(this).attr('type') == 'text'){
				var p = {};
				p[$(this).attr('name')] = $(this).val();
				a.push(p);
			}
		})
		$.ajax({
			url: '/holiday/holiday_save',
			type:'POST',
			cache:false,
			datatype:'json',
			data: {_token: token,c_year: y,c_month: m,c_day:a,submit: 'save',password:pw},
			beforeSend: function(xhr){xhr.setRequestHeader('X-CSRF-TOKEN', $("#token").attr('content'));},
			success: function(data){
				if(data == '密碼錯誤，請重新輸入'){
					alert(data);
					history.go(0);
				}else{
					alert('更新成功！');
					history.go(0);
				}
			},
			error: function(data){
				console.log(data);
				console.log('error');
			}
		})
	})
})