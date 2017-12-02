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

//////////////////////////////

function getDropdownData(user , type){
	var pageName = '';
	if ($(".dropdown_data_window").css("height") == "0px"){

		if (type == 'notification'){
			pageName = 'ajax_load_notifications.php'
		}
		else if (type == 'message'){
			pageName = 'ajax_load_messages.php';
			$("span").remove("#unread_message");
		}

		var ajaxreq = $.ajax({
			url: "includes/handlers/" + pageName,
			type: "POST",
			data: "page=1&userLoggedIn=" + user,
			cache: false,

			success: function(response){
				$(".dropdown_data_window").html(response);
				$(".dropdown_data_window").css({"padding": "0px","height":"420px"});
				$("#dropdown_data_type").val(type);

			}

		});
	}
	else 
	{
		$(".dropdown_data_window").html("");
		$(".dropdown_data_window").css({"padding": "0px","height":"0px"});

	}
}




