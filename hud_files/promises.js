$(document).ready(function() {	
	//select all the a tag with name equal to modal
	
	function display_promises(){
		//Cancel the link behavior
		//e.preventDefault();
		
		//Get the A tag
		var id = '#promisesboxesdialog';
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#promisesmask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#promisesmask').fadeIn(1000);	
		$('#promisesmask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 	
	}
	
	$('.window .close').click(function (e) {
		e.preventDefault();
		jQuery.cookie('promises', 'active', { path: '/' });

		$('#promisesmask').hide();
		$('.window').hide();
	});

	if(jQuery.cookie('promises') !== 'active'){
	// display_promises();
	}
 	
});
