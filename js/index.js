// Created by Zoltán Tóth  2015
var pageItem = {
	formAnimation:function(button, formName){
		$(button).on('click',function(){
			$(formName).css('display','block').addClass('animated zoomIn');
			$('#overlay-back').fadeIn(500);
			$('#buttons').fadeOut(500);
				
		});
		
		$('.close, #overlay-back').on('click', function(){
			$('#phpResult').fadeOut(500);
			$('#overlay-back').fadeOut(500);
			$(formName).css('display','none').removeClass('animated zoomIn');
			$('#buttons').fadeIn(500);	
		});
		var a = false;
		$('#phpResult').mouseover(function(){
			a = true;
		});
		$('#phpResult').mouseout(function(){
			a = false;
			setTimeout(function(){ 
				if(!a) 
				$('#phpResult').fadeOut(500) 
			},700);
		});
		setTimeout(function(){ 
				if(!a) 
				$('#phpResult').fadeOut(500) 
			},2500);
	},
	click:function(){
		
		$('#mainNav a').on('click', function(e){
			e.preventDefault();
			$("#mainNav").fadeOut(900);
			$('.text').fadeOut(100);
			var goTo = this.getAttribute("href");
			$(".brickW").animate({width: 0},900);
			$(".brickH").animate({height: 0},600);
			setTimeout(function(){
				window.location = goTo;
				},900);
			});
	}
}
$(document).ready(function(){
	$(window).load(function() {
		var nav = $("#mainNav");
		$(nav).hide();
		$(nav).fadeIn(500);
		
	});
	pageItem.formAnimation('#singIn', '#signInForm');
	pageItem.formAnimation('#singUp', '#signUpForm');
	pageItem.click();
	
	

	
});//end of ready function