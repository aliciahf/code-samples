$(document).ready(function() {
	
	$('#enter').on('click', 'div', function (e) {
		e.stopPropagation();
		$(this).delay(100).fadeOut(150);
	});
});