$(document).ready(function() {

// 	fungsional maverick theme
	
	/*toggle sidebar*/	
	$(".toggle-sidebar").click(function(){
		$("body").toggleClass("sidebar-collapsed");
	});

	/*toggle dropdown*/	
	$(".dropdown-toggle").click(function(){
		$(this).parent().toggleClass("open");
	});

});