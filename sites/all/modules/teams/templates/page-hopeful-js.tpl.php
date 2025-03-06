<script type="text/javascript">
var sURL = window.parent.location.href; 
if(sURL.search("content_breadcrumb") !== -1){
vURL = sURL;
} else{
vURL = sURL + '#content_breadcrumb';
}

$("#teams_InviteDialog").dialog(
										{
											modal: true,
											autoOpen: true,
											resizable: false,
											width: 650,
											width: 550,
											buttons: {
												"Ok": function(){
													location = Drupal.settings.basePath + "community?m=gr";
												},
												"No Thanks": function(){
													parent.location.href = vURL;
													$(this).dialog("close");
												}
											},
											closeOnEscape: false,
									        open: function(event, ui) { $(".ui-dialog-titlebar-close").hide(); }
										}
									);
</script>
