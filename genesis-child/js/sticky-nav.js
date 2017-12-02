jQuery(function( $ ) {
	//top menu jquery
	var starting_position = $('.site-header').outerHeight( true ) + $('.nav-primary').outerHeight( true );
	$(window).scroll(function() {
		var yPos = ( $(window).scrollTop() );
		if( yPos > starting_position && window.innerWidth > 500 ) { // show sticky menu after these many (starting_position) pixels have been scrolled down from the top and only when viewport width is greater than 500px.
			$(".nav-secondary").fadeIn();
		} else {
			$(".nav-secondary").fadeOut();
		}
	});

//search form
$('#searchheaderbtn').click(function(){
	$('#searchinput').slideToggle('slow');
})



});
