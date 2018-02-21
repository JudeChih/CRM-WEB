$(function(){
	var xx = $('html').height();
  parent.postMessage([{'height':xx}], 'http://192.168.30.102/');
})