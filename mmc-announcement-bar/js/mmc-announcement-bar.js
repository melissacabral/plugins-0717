//jQuery is in noconflict mode in WP, so $ == jQuery

jQuery('.mmc-dismiss').click( function(){
	console.log('hello');
	jQuery('#announcement-bar').remove();
	//band-aid for fixed header
	jQuery('.header-bar').css({ 
		'margin-top' : 0
	});
} );