/* social_net.js */

$(document).ready(function(){

	$('#search_text_input').focus(function() {

	// magnifying glass icon pressed

		if(window.matchMedia( "(min-width: 800px)").matches){

			$(this).animate({width: '250px'}, 500);
		}



	});

	$('.search_button_holder').on('click', function(){
		//val_to_search = $('#search_text_input').text;
		//if (!empty(val_to_search){
			document.search_form.submit();	
		//}
		
	});


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

$(document).click(function(e){

	if(e.target.class != "search_result" && e.target.id != "search_text_input") {

		$(".search_result").html("");
		$(".search_result_footer").html("");
		$(".search_result_footer").toggleClass("search_result_footer_empty");
		$(".search_result_footer").toggleClass("search_result_footer");

	}

	if(e.target.class != "dropdown_data_window" ) {

		$(".dropdown_data_window").html("");
		$(".dropdown_data_window").css({"padding":"0px","height":"0px"});
	}

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

///////////////// new ajax to load the search dropdown //////////
function getLiveSearchUsers(value, user){


	$.post("includes/handlers/ajax_load_search_users.php",
		{query:value, userLoggedIn:user},
		function(data){

			if($(".search_result_footer_empty")[0]){
				$(".search_result_footer_empty").toggleClass("search_result_footer");
				$(".search_result_footer_empty").toggleClass("search_result_footer_empty");
			}

			$(".search_result").html(data);
			$(".search_result_footer").html("<a href='search.php?q='"+ value + "'>See All Results</a>");

			if(data == "") {
				$(".search_result_footer").html("");
				$(".search_result_footer").toggleClass("search_result_footer_empty");
				$(".search_result_footer").toggleClass("search_result_footer");
			}

		});

}

/////////////// search the internet using Google ////////////
function searchGoogle(){

	var q = document.getElementById("search_text_input").value;
	var config="height='100',width='400', toolbar='no', menubar='no', scrollbars='no', resizable='no',
				location='no', directories='no', status='no'";


	if (q != " ")
		window.open('http://google.com/search?q=' + q, '_blank', config);

}









