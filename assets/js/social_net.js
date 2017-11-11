/* social_net.js */

$(document).ready(function(){

	// submit post from profile
	$("#submit_profile_post").click(function(){
		$.ajax({
			type: "POST",
			url: "includes/handlers/ajax_submit_profile_post.php",
			data: $("form.profile_post").serialize(),
			//alert ("data " + $("form.profile_post").serialize());
			success: function(msg){
				$("post_from").modal('hide');
				location.reload();
			},
			error: function(){
				alert("Failure!");
			}
		});
	});
});

// ////////////////////////////

function getUsers(value, user){
	console.log(value);
	console.log(user);

	$.post("includes/handlers/ajax_friend_search.php", {query:value, userLoggedIn:user},
		function (data){
			$(".results").html(data);
		});

};




