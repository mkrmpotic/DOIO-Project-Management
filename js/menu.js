$( document ).ready(function() {
	$( "#user-container" ).click(function() {
		$( "#user-menu-container" ).toggle( "slide", { direction: "right" } );
		$( ".menu-arrow" ).toggle( "slide", { direction: "left" } );
	});

	$( "#logout" ).hover(function() {
		$( "#logout-icon" ).show();
	}, function() {
		$( "#logout-icon" ).hide();
	});

	$( "#settings" ).hover(function() {
		$( "#settings-icon" ).show();
	}, function() {
		$( "#settings-icon" ).hide();
	});

	$( "#menu-icon-container" ).click(function() {
		$( "#main-menu-container" ).toggle( "slide", { direction: "left" } );
		$( "#menu-icon" ).toggle( "slide", { direction: "right" } );
	});
});