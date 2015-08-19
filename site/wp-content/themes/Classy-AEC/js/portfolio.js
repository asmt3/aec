jQuery(function($){
	$(document).ready(function(){
		//slides for single posts
		$('#slides_single').slides({
			generateNextPrev: false,
			pagination: true,
			play: false,
			pause: 2500,
			hoverPause: true,
			autoHeight: true
		});
		//related carousel
			$('.carousel').elegantcarousel({
			delay:150,
			fade:300,
			slide:500,
			effect:'fade',	  
			next: 'next',
			orientation:'horizontal',
			loop: false,
			autoplay: false,
			time: 4000
		});
	}); // END doc ready
}); // END function