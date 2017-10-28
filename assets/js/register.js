// register.js
$(document).ready(function(){

	// on click of signup hide login, show registration
	$("#signup").click(function(){
		$("#first").slideUp("slow" , function(){
			$("#fname").val("");
			$("#lname").val("");
			$("#email").val("");
			$("#email1").val("");
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