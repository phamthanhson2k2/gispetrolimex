// JavaScript Document
$(document).ready(function(e) {
    $('.prod-img').fancybox({
		padding: 0,
		openEffect : 'elastic',
		openSpeed  : 150,
		closeEffect : 'elastic',
		closeSpeed  : 150,
		closeClick : true,
		helpers : {
			overlay : null
		}
	});
});