// JavaScript Document
$(document).ready(function(e) {
    if($(window).width() >= 992){
		$('#slider').html("<img  src=\"template/default/slide-show/1.png\" alt=\"Slide show\" class=\"img-responsive\"  />"
			+"<img  src=\"template/default/slide-show/2.png\" alt=\"Slide show\" class=\"img-responsive\" />"
			+"<img  src=\"template/default/slide-show/3.png\" alt=\"Slide show\" class=\"img-responsive\" />"
			+"<img  src=\"template/default/slide-show/4.png\" alt=\"Slide show\" class=\"img-responsive\" />"
			+"<img  src=\"template/default/slide-show/5.png\" alt=\"Slide show\" class=\"img-responsive\" />"
			+"<img  src=\"template/default/slide-show/6.png\" alt=\"Slide show\" class=\"img-responsive\" />"
			+"<img  src=\"template/default/slide-show/7.png\" alt=\"Slide show\" class=\"img-responsive\" />"
			);
		$('#slider').nivoSlider({
			pauseTime: 3000,
			directionNav: false,
			controlNav: false,
			pauseOnHover: true
		});
	}
});