<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
?>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<div id="schedule_respond_Dialog" title="Schedule" style="display:none;">
	<div id="schedule_respond_Dialog_content"></div>
</div>

<script type="text/javascript">
$(document).ready(
	function(){
$("#schedule_respond_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 630,
						height: 470,
						buttons: {
							"Yes, I will volunteer": function(){
							respond_schedule_save('<?=$_GET['id']?>', '1');
							},
							"No, I will not volunteer": function(){
							respond_schedule_save('<?=$_GET['id']?>', '2');
							},
							"Cancel": function(){
							$(this).dialog("close");
							}
						}
	});	
	
	$("#schedule_respond_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
	$.post(
	"/volunteer/CybGetContent",
	{
	type: "schedule-respond",
	id: '<?=$_GET['id']?>'
	},
	function(oReply){
		$("#schedule_respond_Dialog_content").html(oReply.OUTPUT);
	},
	"json"
	);
	}
);
</script>

<script type="text/javascript">
function respond_schedule_save(id, status){

	var comment = $("#ischedcomment").val();
	
	$("#schedule_respond_Dialog_content").html('<img src="/misc/button-loader-big.gif" /><span>');
	$.post(
	"/volunteer/CybGetContent",
	{
	type: "schedule-respond-save",
	id: id,
	status: status,
	comment: comment
	},
	function(oReply){
	    $("#schedule_respond_Dialog").dialog("close");
		$.post(
		"/volunteer/CybGetContent",
		{type: "schedule"},
		function(oReply){
			$("#schedule_respond_Dialog").dialog({
						modal: true,
						autoOpen: true,
						resizable: false,
						width: 330,
						height: 240,
						buttons: {
						}
			});	
		
			$("#schedule_respond_Dialog_content").html("Thank you, the admin will know of your response.");
		},
		"json"
		);
	},
	"json"
	);
}
</script>