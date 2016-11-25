$(function(){
	$('form').submit(function(){
		console.log(1);
    var isFormValid = true;
    $(this).find('.problem_subject').each(function(){
      var $this = $(this);
      console.log($this.find('input:checked').val());
      // 使用 trim 把空白去除
      if ($this.find('input:checked').val()== null){
      		$this.parents('div').addClass('error');
      		isFormValid = false;
      }else{
      	$this.parents('div').removeClass('error');
      }
    });
    if(isFormValid){
    	$('#error_tip').addClass('error_tip');
    }else{
    	$('#error_tip').removeClass('error_tip');
    }
    return isFormValid;
	});
})