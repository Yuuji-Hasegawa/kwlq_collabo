$('.navBtn').on('click', function(){
 　　$(this).children().toggleClass('is-nav-open');
 	if($(this).children().hasClass('is-nav-open')) {
 		$(this).attr({'aria-expanded' : 'true'});
 		$('.gnav').slideDown(400,'swing');
 	} else {
 		$(this).attr({'aria-expanded' : 'false'});
 		$('.gnav').slideUp(400,'swing');
 	}
});
/*
$(document).ready(function(){
	if($('header').hasClass('fixed')) {
		var fix = $('header');
		var fixh = fix.outerHeight() + "px";
		$("body").css("padding-top",fixh);
	}
});
$(window).on('resize', function(){
	if($('header').hasClass('fixed')) {
		var fix = $('header');
		var fixh = fix.outerHeight() + "px";
		$("body").css("padding-top",fixh);
	}
});*/