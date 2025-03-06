$(document).ready(function(){
	$('.workz-mobile-column-clickable').live('click', function(){
		let kindness_id = $(this).attr('kindness_id');

		Kindness_ApproveTitle2(kindness_id);
	});
})

function Kindness_ApproveTitle2(id){
	document.getElementById('KSPopUp').style.display = 'block';
	document.getElementById('KSPopUpOverlay').style.display = 'block';
	$.ajax({
		url: '/kindness/details2/' + id + '/true/' + $("#env_pop").val(),
		  dataType: 'text',
		  success: function(data) {
			$("#hud_KSText").html(data);
			document.getElementById('KSPopUpOverlay').style.display = 'none';

		  },
		  error: function() {
			$("#hud_KSText").html("There was a problem with your request<br />"); 
			document.getElementById('KSPopUpOverlay').style.display = 'none';
		  }
		});

}