jQuery(document).ready(function() {
		//When page loads...
		jQuery(".tab_content").hide(); //Hide all content
		jQuery("ul.tabs li:first").addClass("active").show(); //Activate first tab
		jQuery(".tab_content:first").show(); //Show first tab content
	
		jQuery(function() {

			//when the history state changes, gets the url from the hash and display 
			jQuery(window).bind( 'hashchange', function(e) {
				
				var url = jQuery.param.fragment();
				//hide all 
				jQuery( '.tabs li' ).removeClass( 'active' );
				jQuery( '.tab_container' ).children(".tab_content").removeClass(".active").hide();
		
				//find a href that matches url
				if (url) {
					jQuery( 'ul.tabs a[href="#' + url + '"]' ).parent().addClass( 'active' ); 
					jQuery(".tab_container #" + url).addClass("selected").fadeIn();
				} else {
					jQuery( 'ul.tabs a[href="#tab1"]' ).parent().addClass( 'active' ); 
					jQuery(".tab_container #tab1").addClass("active").fadeIn();
				}		
			});
	  
			// Since the event is only triggered when the hash changes, we need to trigger
			// the event now, to handle the hash the page may have loaded with.
			jQuery(window).trigger( 'hashchange' );			
		});
});