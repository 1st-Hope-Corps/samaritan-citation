<link class="ka_style" rel="stylesheet" type="text/css" href="<?php echo base_path()?>misc/kickaps/ka_generalStyle.css" />
<link class="ka_style" rel="stylesheet" id="LE_setCSS" type="text/css" href="<?php print base_path().path_to_theme() ?>/usernavaccount.css" />
<link type="text/css" rel="stylesheet" media="all" href="<?php print base_path().path_to_theme() ?>/kickapps_members.css" />

<!--<link type="text/css" rel="stylesheet" media="all" href="http://jqueryui.com/themes/base/jquery.ui.all.css" />
<script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="http://jqueryui.com/ui/jquery.ui.tabs.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="http://jqueryui.com/demos/demos.css" />
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>-->

<script type="text/javascript" src="<?php echo base_path()?>misc/jqueryui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo base_path()?>misc/jqueryui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo base_path()?>misc/jqueryui/jquery.ui.tabs.js"></script>
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_path()?>misc/jqueryui/demos.css" />
<link href="<?php echo base_path()?>misc/jqueryui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script>
	$(function() {
		$( "#Accounttabs" ).tabs();
	});
	</script>
				<div id="cbtop">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="i1">
							<div class="i2">
								<div class="i3">
									<div class="left-border">
										<div class="right-border">
											<table width="970" border="0" cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<div class="main_content">
														
															<?php if ($is_front != ""): ?>
																<div id="custom">
																	<?php print $custom?>
																</div>
															<?php endif; ?>
																		
															<?php
															global $user;
															
															if($user->uid){	
																$urlpath = $_GET['q'];
																if(preg_replace('/[^a-z]/i', '', $urlpath) == 'messagesview'){
																	$urlpath = 'messagesview';
																}
																		
																if($_SERVER['REQUEST_URI'] == '/user/'.$user->uid.'?misc'){
																	$urlpath = 'user/'.$user->uid.'?misc';
																}
																global $user;
																switch( $urlpath ) {
																	case 'community':
																	case 'faq':
																		print $content;	
																	break;
																	case 'time/buy':
																		time_buy_page($content);
																	break;
																	default:
																		if($user->name == 'admin'){
																			// $title = str_replace('Kindness', 'Citation', $title);
																		  echo user_adminaccountTabs($tabs, $title, $urlpath, $content, $tabs2, $show_messages, $messages, $help);
																		  //print $content; 
																		} else{
																			if ( 0 === strpos( $urlpath, 'user/' . $user->uid ) ) {
																				echo user_accountTabs($tabs, $title, $urlpath, $content, $show_messages, $messages);
																			} else {
																				echo $content;
																			}
																		}
																}
															} else {
																echo $content;
															}
															?>
														</div>
													</td>
													<?php if ($right != "") { ?>		
													<td width="250">
														<?php echo $right; ?>
													</td>
													<?php } ?>
												</tr>	
											</table>
										</div>
									</div>	
								</div>	
							</div>
						</div>
						<div class="bb">
							<div></div>
						</div>
					</div>
				</div>
				
				<?php if(!empty($bottom_content)) { ?>
				<div class="divider"></div>
				<div id="cbbottom">
					<div class="cb">
						<div class="bt">
							<div></div>
						</div>
						<div class="bb">
							<div></div>
						</div>
					</div>
				</div>
				<?php } ?>
<?php
global $user;
if($user->uid){
?>
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php print base_path().path_to_theme() ?>/sf/superfish.css" />
<link rel="stylesheet" type="text/css" href="<?php print base_path().path_to_theme() ?>/sf/superfish-navbar.css" /> 
<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/sf/superfish.js"></script>

<div id="usernotify_Dialog" title="User Notification" style="display:none;">
	<div id="usernotify_msg"></div>
</div>

<?php
									  $sqlNotify = "SELECT uid, module
													FROM user_notification
													WHERE uid = '{$user->uid}' and accept = 0";
									
													$oSQLNotifyResult = db_query($sqlNotify, $user->uid);
									
													$oSQL = db_fetch_object($oSQLNotifyResult);
													
													if($oSQL->module !== "" && $oSQL->uid == $user->uid){
													echo '<script>
															$("ul.sf-menu").superfish({ 
																pathClass:  "current" 
															}); 
		
															$("#usernotify_msg").html("Your have been removed from your team and position as a cybrarian.");
																				
															$("#usernotify_Dialog").dialog({
																			modal: true,
																			autoOpen: true,
																			resizable: false,
																			width: 530,
																			buttons: {
																				"Confirm": function(){
																						$.post(
																							"/user/notify/all/" + '.$user->uid.',
																							{func: ""},
																							function(oReply){
																								//if(oReply.STATUS == "Success"){
																									//$("#usernotify_Dialog").dialog("close");
																									//$(this).dialog("close");
																								//}
																							},
																							"json"
																						);
																						$(this).dialog("close");
																				}, 
																				"Cancel": function(){
																					$(this).dialog("close");
																				}
																			}
															});
														  </script>		
														  ';
													}
}
?>
