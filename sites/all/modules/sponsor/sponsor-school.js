(function($){
	$.fn.center = function (bAbsolute){
		return this.each(
			function (){
				var oMainFunc = jQuery(this);

				oMainFunc
					.css(
						{
							position:	(bAbsolute) ? "absolute" : "fixed", 
							left:		"50%",
							top:		"50%",
							zIndex:		"9000"
						}
					)
					.css(
						{
							marginLeft:	"-" + (oMainFunc.outerWidth() / 2) + "px", 
							marginTop:	"-" + (oMainFunc.outerHeight() / 2) + "px"
						}
					);

				if (bAbsolute){
					oMainFunc.css(
						{
							marginTop:	parseInt(oMainFunc.css("marginTop"), 10) + jQuery(window).scrollTop(), 
							marginLeft:	parseInt(oMainFunc.css("marginLeft"), 10) + jQuery(window).scrollLeft()
						}
					);
				}
			}
		);
	}
})(jQuery);

$(document).ready(
	function(){		

	$("#fund_status").click(
			function(){
				$("#status_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 730,
						buttons: {
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	$("#listed_funding").click(
			function(){
				$("#listed_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	$("#amount_select").change(
			function() {
				$("#fund_label").text('$'+this.value);
				$("#pledge_label").text('$'+this.value);	
				$("#amount_selected").val(this.value);					
			}
		);
	$("#fund_select").click(
			function() {
			$("#checkout_dash").fadeIn('slow', function() {});
			$("#select_dash").hide(); 
			$("#adoption_amount").val($("#amount_selected").val());
			var totaladd = (10 / 100) * parseFloat($("#amount_selected").val()); 
			var totaldonation = parseFloat($("#amount_selected").val()) + totaladd;
			$("#percentage").text(totaladd);	
			$("#total_donation").text(totaldonation);				
			}
		);
	$("#cancel_select").click(
			function(){
				$("#select_dash").fadeIn('slow', function() {});
				$("#checkout_dash").hide();
			}
		);
	$("#pledge_select").click(
			function() {
			$("#checkout_dash").fadeIn('slow', function() {});
			$("#select_dash").hide();
			$("#adoption_amount").val($("#amount_selected").val());	
			var totaladd = (10 / 100) * parseFloat($("#amount_selected").val()); 
			var totaldonation = parseFloat($("#amount_selected").val()) + totaladd;
			$("#percentage").text(totaladd);		
			$("#total_donation").text(totaldonation);		
			}
		);
	
	$("#adoption_amount").change(
		function() {		
			var totaladd = (10 / 100) * parseFloat(this.value); 
			var totaldonation = parseFloat(this.value) + totaladd;
			$("#percentage").text(totaladd);		
			$("#total_donation").text(totaldonation);	
		}	
	);
	
	$("#edit_percentage").click(
		function() {		
			var percentage = parseFloat($("#percentage").text());
			$("#percentage_amount").val(percentage);
			$("#percentdiv").hide();
			$("#percentage_div").show();
		}	
	); 
	
	$("#percentage_amount").change(
		function() {		
			var totaldonation = parseFloat($("#adoption_amount").val()) + parseFloat(this.value);
			$("#percentage").text(this.value);		
			$("#total_donation").text(totaldonation);	
			$("#percentdiv").show();
			$("#percentage_div").hide();
		}	
	);
	
	$("#choose_adoption_option").click(
			function(){
				$("#choose_adoption_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 590,
						buttons: {
							/*"Select": function(){
								var allVals = [];
								 $('#adopt_opt :checked').each(function() {
								   allVals.push($(this).val());
								 });
								 $('#adoption_option').text(allVals);
							},*/
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 
	
	var amountselect = $("#amount_select").val();
	$("#fund_label").text('$'+amountselect);
	$("#pledge_label").text('$'+amountselect);
		
	$("#general_fund").click(
		function(){

			if($('#general_fund').is(':checked') == true){

				$('#admin_tasks').attr('checked','checked');
				$('#cybrary_hopenet').attr('checked','checked');
				$('#maintenance_tasks').attr('checked','checked');
				
				$('#admin_tasks').attr('disabled','disabled');
				$('#cybrary_hopenet').attr('disabled','disabled');
				$('#maintenance_tasks').attr('disabled','disabled');
				
			    $('#adoption_option').html("<center>Hope Cybrary Operations - General Fund</center>");	
			} else{

				$('#admin_tasks').removeAttr('checked');
				$('#cybrary_hopenet').removeAttr('checked');
				$('#maintenance_tasks').removeAttr('checked');
				
				$('#admin_tasks').removeAttr('disabled','disabled');
				$('#cybrary_hopenet').removeAttr('disabled','disabled');
				$('#maintenance_tasks').removeAttr('disabled','disabled');
				
				$('#adoption_option').html("");	
			}
		  }
		); 
		
	  $("#admin_tasks").click(
		 function(){
			if($('#admin_tasks').is(':checked') == true){
				$('#cybrary_hopenet').removeAttr('checked');
				$('#maintenance_tasks').removeAttr('checked');
				$('#cybrary_hopenet').attr('disabled','disabled');
				$('#maintenance_tasks').attr('disabled','disabled');
				
				$('#adoption_option').html("<center>Admin Tasks</center>");	
			} else{
				$('#cybrary_hopenet').removeAttr('disabled','disabled');
				$('#maintenance_tasks').removeAttr('disabled','disabled');
				
				$('#adoption_option').html("");	
			}
		 }
		);
	
	  $("#cybrary_hopenet").click(
		 function(){
			if($('#cybrary_hopenet').is(':checked') == true){
				$('#admin_tasks').removeAttr('checked');
				$('#maintenance_tasks').removeAttr('checked');
				$('#admin_tasks').attr('disabled','disabled');
				$('#maintenance_tasks').attr('disabled','disabled');
				
				$('#adoption_option').html("<center>Cybrary and H0peNet Operational Tasks</center>");	
			} else{
				$('#admin_tasks').removeAttr('disabled','disabled');
				$('#maintenance_tasks').removeAttr('disabled','disabled');
				
				$('#adoption_option').html("");	
			}
		 }
		);
		
	  $("#maintenance_tasks").click(
		 function(){
			if($('#maintenance_tasks').is(':checked') == true){
				$('#admin_tasks').removeAttr('checked');
				$('#cybrary_hopenet').removeAttr('checked');
				$('#admin_tasks').attr('disabled','disabled');
				$('#cybrary_hopenet').attr('disabled','disabled');
				
				$('#adoption_option').html("<center>Maintenance and Supporting Tasks</center>");	
			} else{
				$('#admin_tasks').removeAttr('disabled','disabled');
				$('#cybrary_hopenet').removeAttr('disabled','disabled');
				
				$('#adoption_option').html("");	
			}
		 }
		);
		
		$("#funding_details_more").click(
		 function(){
			$("#funding_details").hide();
			$("#funding_details_expand").show();
		 }
		);
		
		$("#funding_details_less").click(
		 function(){
			$("#funding_details").show();
			$("#funding_details_expand").hide();
		 }
		); 
		
		$("#confirm_select").click(
		 function(){
			$("#confirm_adoption_amount").text($("#adoption_amount").val());
			$("#confirm_adoption_option").text($("#adoption_option").text());
			$("#confirm_percentage").text($("#percentage").text());
			$("#confirm_adopt_team").text($("#adopt_team").val());
			$("#confirm_total_donation").text($("#total_donation").text());
		    $("#confirm_dash").fadeIn('slow', function() {});
			$("#checkout_dash").hide();
		 }
		); 
		
		$("#back_checkout").click(
		 function(){
		    $("#checkout_dash").fadeIn('slow', function() {});
			$("#confirm_dash").hide();
		 }
		);
		
		$("#optional_program").click(
			function(){
				$("#optional_program_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		);

		$("#credit_donation").click(
			function(){
				$("#credit_donation_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 490,
						buttons: {
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		);

		$("#paypal_select").click(
			function(){
				$("#paypal_select_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 960,
						buttons: {
							"Pay Now (Testing)": function(){
								var amount = $("#confirm_total_donation").text();	
								var confirmadoptionoption = $("#confirm_adoption_option").text();
								var adoptteam = $("#adopt_team").val();
								var schoolname = $("#schoolname").text();

								$.post(
									"/mystudies/getinvolved/adopt/school/paynow",
									{
										amount: amount,
										adoptoption: confirmadoptionoption,
										adoptteam: adoptteam,
										schoolname: schoolname
									},
									function(sReturn){
										alert('Thank you. You will be redirected to the dashboard');
										location.href = "<?php echo base_path()?>mystudies/getinvolved/adopt/school/select";
									}
								);

							},
							"Close": function(){
							$(this).dialog("close");
							}
						}
				});
			}
		); 	
		
	}
);