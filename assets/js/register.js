// register.js
$(document).ready(function(){

	// on click of signup hide login, show registration
	$("#signup").click(function(){
		$("#first").slideUp("slow" , function(){
			$("#second").slideDown("slow");
		});
	});

	// on click of signin hide registration, show login
	$("#signin").click(function(){
		$("#second").slideUp("slow" , function(){
			$("#first").slideDown("slow");
		});
	});

});