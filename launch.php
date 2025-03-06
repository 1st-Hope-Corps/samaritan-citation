<?php
require_once './includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

if($_GET['q'] == 1){
$gamename = $_GET['game'];
?>
<div onclick="alert('testing you clicked the game');">
<script language="javascript" type="text/javascript">
Spoon_DisplayMode = 'button';
Spoon_AppName = '<?=$gamename?>';
Spoon_HideIfUnsupported = false;
</script>
<script language="javascript" type="text/javascript" src="http://start.spoon.net/feed">
</script>
</div>
<?php
}else{
$spoonid = $_GET['spoonid'];

$sqlCat = "SELECT * FROM {spoon_accounts} where spoon_id = '{$spoonid}'";

$oValues = db_query($sqlCat);
	
while ($oValue = db_fetch_object($oValues)){
	$spoon_email = $oValue->spoon_email;
	$spoon_password = $oValue->spoon_password;
}

?>
<html>
<head>
</head>
<body>
<form name="aspnetForm" method="post" action="https://secure.spoon.net/Manage/Login.aspx?Redir=1" id="aspnetForm">
<div>
<input type="hidden" name="__EVENTTARGET" id="__EVENTTARGET" value="" />
<input type="hidden" name="__EVENTARGUMENT" id="__EVENTARGUMENT" value="" />
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="" />
</div>
    <div style="margin-left: auto; margin-right: auto; width: 100%;">
        <div id="BannerContainer">
            <div id="BannerContent">
                <a href="/">
                    <div id="Logo"></div>
                </a>
            </div>
        </div>
        <!-- End Spoon banner -->
        <!-- Start page content -->
        <div id="Container">
            <div id="ContentContainerPad">
    <div id="MainColumn">
        <div id="MainColumnContent">
            <div id="MainColumn"> 
                <div id="MainColumnContent"> 
			        <div class="AccountAccessForm" id="SignIn"> 
				        <div> 
                            <input name="ctl00$ctl00$body$MainColumnContentPlaceHolder$txtEmail" type="hidden" id="ctl00_ctl00_body_MainColumnContentPlaceHolder_txtEmail" value="<?=$spoon_email?>" style="width:180px;" />
				        </div> 
				        <div> 
                            <input name="ctl00$ctl00$body$MainColumnContentPlaceHolder$txtPassword" type="hidden" id="ctl00_ctl00_body_MainColumnContentPlaceHolder_txtPassword" value="<?=$spoon_password?>" style="width:180px;" />
				        </div> 
				        <div> 
					        <label></label> 
                        </div>
				        <div> 
                            <label></label>
				        </div> 
                        <div class="Clear"></div>
                        <span id="ctl00_ctl00_body_MainColumnContentPlaceHolder_valLoginError" style="color:Red;display:none;"></span>
				        <div style="padding-top:12px"> 
					        <label></label> 
                            <input type="hidden" name="ctl00$ctl00$body$MainColumnContentPlaceHolder$btnLogin" value="Sign In" onclick="javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions(&quot;ctl00$ctl00$body$MainColumnContentPlaceHolder$btnLogin&quot;, &quot;&quot;, true, &quot;&quot;, &quot;&quot;, false, false))" id="ctl00_ctl00_body_MainColumnContentPlaceHolder_btnLogin" style="height:30px;width:140px;" />
				        </div> 
			        </div> 

                </div> 
            </div> 
        </div>
    </div>
    <div class="Clear">
    </div>
            </div>
            <div class="Clear">
            </div>
        </div>
        <!-- End page content -->
    </div>
</form>
<script>
document.forms.aspnetForm.submit();
</script>
</body>
</html>
<?php
}
?>