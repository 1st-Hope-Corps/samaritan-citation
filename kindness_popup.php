<?php
# --BEGIN No caching
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
//header("Cache-Control: no-store, no-cache, must-revalidate"); 
//header("Cache-Control: post-check=0, pre-check=0", false); 
//header("Pragma: no-cache");
# --END No caching

// Load Drupal's core.
require_once "./includes/bootstrap.inc";
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$uid = _kindness_converttoID($_GET['user']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta http-equiv="Cache-Control" content="no-cache">

<title>Cybrary Heads Up Display</title>
<link type="text/css" href="sites/all/modules/mystudies/jquery.treeview.css" rel="stylesheet" />
<!--<link type="text/css" href="sites/all/modules/devel/devel.css" rel="stylesheet" />-->
<?php
if($_GET['env'] == 'ext'){
?>
<link type="text/css" href="hud_files/kindness_popup_ext.css" rel="stylesheet" />
<?php
} else{
?>
<link type="text/css" href="hud_files/style.css" rel="stylesheet" />
<?php
}
?>
<link type="text/css" href="hud_files/jquery.treeview.css" rel="stylesheet" />
<link type="text/css" href="home_files/jquery.jScrollPane.css" rel="stylesheet" />
<link rel="stylesheet" href="misc/pagination.css" />
<script type="text/javascript" src="misc/jquery.js?q"></script>
<script type="text/javascript" src="sites/all/modules/mystudies/jquery.cookie.js?q"></script>
<script type="text/javascript" src="home_files/jquery.mousewheel.js"></script>
<script type="text/javascript" src="home_files/jquery.jScrollPane.js"></script>                                     
<script type="text/javascript" src="misc/jquery.pagination.js"></script>
<script type="text/javascript" src="hud_files/kindness.js?q"></script>
</head>

<body id='body2'> 
    <div>
		<!-- BEGIN Kindness Content -->
		<!-- Kindness Status/Dashboard -->
		<div >
			<div>
			    <input type="hidden" id="uid_pop" name="uid_pop" value="<?=$uid?>" />
				<input type="hidden" id="env_pop" name="env_pop" value="<?=$_GET['env']?>" />
				<div class="kindness-content02">
				<?php
				if($_GET['env'] == 'ext'){
				?>
					<div id='KSPopUp' style='display:none; background-color:white; position:absolute; margin:323px 800 0 300px;border: 1px solid black; width: 400px; height: 400px; z-index:100;'>
						<div style='text-align: right;'><a onmouseover='this.style.cursor="pointer" ' style='font-size: 12px;' onfocus='this.blur();' onclick="document.getElementById('KSPopUp').style.display = 'none';document.getElementById('out').style.display = 'none';document.getElementById('in').style.display = 'block';document.getElementById('KSPopUp').style.display = 'none' " ><img src="hud_files/images/btn-close.png" border="0"></a></div>
						<div><div style="color:black;font-size:14px;" align="center">Kindness Workz Details</div></div>
						<div style='text-align: left;padding-top:5px;padding-left:5px;overflow-y:auto;overflow-x:hidden;width:390px;height:360px;' id="hud_KSText">loading..</div>
					</div>
				<?php
				} else{
				?>		
					<div id='KSPopUp' style='display:none; background-color:#051700; position:absolute; margin:323px 800 0 300px;border: 1px solid #fefe00; width: 400px; height: 400px; z-index:100;'>
						<div style='text-align: right;'><a onmouseover='this.style.cursor="pointer" ' style='font-size: 12px;' onfocus='this.blur();' onclick="document.getElementById('KSPopUp').style.display = 'none';document.getElementById('out').style.display = 'none';document.getElementById('in').style.display = 'block';document.getElementById('KSPopUp').style.display = 'none' " ><img src="hud_files/images/btn-close.png" border="0"></a></div>
						<div><div style="color:#f3ee18;font-size:14px;" align="center">Kindness Workz Details</div></div>
						<div style='text-align: left;padding-top:5px;padding-left:5px;overflow-y:auto;overflow-x:hidden;width:390px;height:360px;' id="hud_KSText">loading..</div>
					</div>
				<?php
				}
				?>				
					<div class="kindness-txt kindness-dashboard-box" id="kindness_dashboard_details"></div>
					
					<?php
					if($_GET['env'] == 'ext'){
					?>
					<div class="kindness-txt">
						<h3 style="color:black">Kindness Workz Hours : Pending - Approved - Disapproved</h3>
					   <div class="pending_top_txt">
							<div class="pending_top_title" style="color:black">Title</div>
							<div class="pending_top_duration" style="color:black">Duration</div>
							<div class="pending_top_date" style="color:black">Date Reported</div>
							<div class="pending_top_monitor" style="color:black">Mentor</div>
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_approved_list"></div>
						
						<div align="center" style="font-weight:normal; padding-top:260px; color:black;">
							To see the details, click on the title of the Kindness Workz.
						</div>
					</div>
					<?php
					} else{
					?>
					<div class="kindness-txt">
						<h3>Kindness Workz Hours : Pending - Approved - Disapproved</h3>
					   <div class="pending_top_txt">
							<div class="pending_top_title">Title</div>
							<div class="pending_top_duration">Duration</div>
							<div class="pending_top_date">Date Reported</div>
							<div class="pending_top_monitor">Mentor</div>
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_approved_list"></div>
						<div align="center" style="font-weight:normal; padding-top:260px; color:#FFE800;">
							To see the details, click on the title of the Kindness Workz.
						</div>
					</div>
					<?php
					}
					?>
				</div>

			</div>
		</div>
		<!-- Kindness Status/Dashboard -->
		
		<!-- Kindness Convert -->
		<div class="wrapper-kindness" id="kindness_content_convert">
			<div>
				<div class="bank-r">
					<div class="kind_navi">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_about')"><span>About</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_form')"><span>Kindness Report</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_dashboard')"><span>Kindness Status</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_convert')" class="active"><span>Convert</span></a></li>
						</ul>
					</div>
					<div class="kindness_box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="kindness-content02">
					<div class="kindness-txt">
						<div class="box01" style="color:#FFF200; width:230px; font-size:1.0em; background:url(hud_files/images/welcome_tutring.png) no-repeat scroll 0 0 transparent;">
							Convert Kindness Workz to Hope Bucks
						</div>
						
						<div id="kindness_details_panel" class="kindness_panel_area"></div>
						<table style="float:left;">
							<tr>
								<td>
									<div class="kindness-account-info">
										To convert your Kindness Workz hours to Hope Bucks: first check your Kindness Workz balance. 
										Type in the number of hours you wish to convert and then click "Convert to Hope Bucks" button. 
										The Hope Bucks will be immediately deposited into your my eBank account.
									</div>
								</td>
								<td style="vertical-align:top;">
									<h3>Kindness Hours :</h3>
									
									<div class="kindness_panel_area2"> Kindness Hours<span>*</span></div>
									<div class="kindness_input_area">
										<div class="kindness_input_bg">
											<input name="iKindnessToConvert" type="text" class="kindness_input_search" id="iKindnessToConvert" border="0" />
										</div><br/>
										<div style="margin-top:20px; font-weight:normal; font-size:0.9em;">
											Amount of Kindness Workz Hours to be converted.<br>
											Example correct entries: 1. 1.5, 0.25 etc.
										</div>
									</div>
									
									<div class="kindness_panel_btn" id="KindnessConvertDiv">
										<input id="btnKindnessConvert" name="btnKindnessConvert" onclick="Kindness_SetConvert()" type="button" value="Convert To Hope Bucks" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#e5f031'" style="background:url(./hud_files/images/buttonbg.jpg); cursor:pointer; border:#FFFFFF solid 1px; width:150px; height: 18px; font-family:Arial, Helvetica, sans-serif;font-size:11px; color:#e5f031"/>
									</div>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- Kindness Convert -->
		
		<!-- Kindness Pending/Approved -->
		<div class="wrapper-kindness" id="kindness_content_pending_approved">
			<div class="wrapper-kindness01">
				<div class="pending-title">Kindness</div>
				<div class="kindness-image kindness_image_pending"></div>
				<div class="kindness-content01">Our hopeNet knowledgePortal services are 
					powered by your kidness. It won?t cost you 
					a single peso, but we will ask you to help 
					out and make your community a better place 
					to live by doing some Acts of Kindness.</div>
			</div>
			<div class="wrapper-bank-r">
				<div class="bank-r">
					<div class="kind_navi">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_dashboard')"><span>About</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_form')"><span>Kindness Report</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_pending_approved')" class="active"><span>Pending/Approved</span></a></li>
							<li><a href="javascript:ToggleContent('kindness_convert')"><span>Convert</span></a></li>
						</ul>
					</div>
					<div class="kindness_box02">
						<div class="in-box1">Balances:</div>
						<div class="in-box2"><span id="bank_balance"></span> Hope Bucks</div>
					</div>
				</div>
				<div class="kindness-content02">
					<div class="kindness-txt">
						<h3>Kindness Hours :</h3>
					   <div class="pending_top_txt">
							<div class="pending_top_title">Title</div>
							<div class="pending_top_duration">Duration</div>
							<div class="pending_top_date">Date Submitted</div>
							<div class="pending_top_date_approvd">Date Approved</div>
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_approved_list"></div>
						
						<div class="pending_kindness_txt">Pending Kindness </div>
						<div class="pending_top_txt">
							<div class="pending_top_title">Title</div>
							<div class="pending_top_duration">Duration</div>
							<div class="pending_top_date">Date Submitted</div>
						</div>
						<div class="pending-strip"></div>
						<div id="kindness_pending_list"></div>	
					</div>
				</div>
				<div class="bottom_menu_area">
					<div class="quick_link"><a href="#">Quick Links:</a></div>
					<div class="bottom_menu">
						<ul>
							<li><a href="javascript:ToggleContent('kindness_convert')">Convert</a></li>
							<li><a href="javascript:ToggleContent('kindness_pending_approved')" class="active">Pending/Approved</a></li>
							<li><a href="javascript:ToggleContent('kindness_form')">Report</a></li>
							<li><a href="javascript:ToggleContent('kindness_dashboard')">About</a></li>
						</ul>
					</div>
				</div>
			</div>

		</div>
		<!-- Kindness Pending/Approved -->
		<div class="clear"></div>
	</div>
	<script>
	$(document).ready(
		function(){	
			ToggleContent('kindness_dashboard');
		}
	);
	</script>
</body>

</html>
<?php
set_time_limit(30);
flush();
ob_flush();
mysqli_close();
?>