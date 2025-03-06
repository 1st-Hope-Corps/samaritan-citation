<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
?>
<link href="/misc/jqueryui/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="/themes/theme2010/style.css" rel="stylesheet" type="text/css"/>
<script src="/misc/jqueryui/jquery.min.js"></script>
<script src="/misc/jqueryui/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php print base_path().path_to_theme() ?>/jquery.jcarousel.min.js"></script>

<?php
drupal_add_js(
		"$(document).ready(
			function(){
				jQuery('#mycarousel2').jcarousel({
				//wrap: 'circular'
				//itemFallbackDimension : 210
				start: 3
				});
				$('#mycarousel2').attr('style','overflow:visible;');
			}
		);",
		"inline"
	);
	$html = '<p><center><h4>Hope Cybrary - Maximo Estrella Elementary School <br/> $2000 Invested - by 8 members</h4></center></p><hr/>';
			
	$html .= '<ul id="mycarousel2" class="jcarousel-skin-sponsors-investors" style="overflow:visible;">';
											
			$query_teamsusers = db_query("select distinct B.uid, A.adopt_option, B.name, B.picture  from invest_donations A left join users B on B.uid = A.uid where A.adopt_team = '".$_GET['teamid']."'");
				//echo "select B.uid, B.name, B.picture  from invest_donations A left join users B on B.uid = A.uid where A.adopt_team = '".$steam_id."'";
											$countteamusers = 1;
											while($set_teamuser = db_fetch_object($query_teamsusers)){
											$html .= '<li>
														<img src="http://www.hopecybrary.org/'.$set_teamuser->picture.'" width="100" height="100" /><br/>
														<center style="color:black;"><b>'.$set_teamuser->name.'</b><br/>';
											
											$invest = db_result(db_query("select SUM(amount) from invest_donations where uid = '".$set_teamuser->uid."'"));
											
											if($invest == ''){
											$invest = 0;
											} else{
											$invest = $invest;
											}
											
											$html .= '$'.$invest.' Invested<br/><br/>
											<b>Adopted Program:</b><br/>
											'.$set_teamuser->adopt_option.'
											</center>
											
													</li>';
													
											$countteamusers++;
											}
											
	$html .= '</ul>';		
			
	$html .= '</div>';
	echo $html;
?>