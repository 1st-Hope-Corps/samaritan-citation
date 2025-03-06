<?php
exit;
$sEmailVal = (isset($_GET["u"])) ? $_GET["u"]:"";
$sPassVal = (isset($_GET["p"])) ? $_GET["p"]:"";
 $homepage = file_get_contents('http://tmpmoodle.hopecybrary.org/login/index2.php?u='.$sEmailVal.'&p='.$sPassVal);
// $homepage = file_get_contents('http://www.hopegames.info/my');
echo $homepage; 
if(isset($_GET['mainpath'])) {
$btr= md5(uniqid(rand(), true));
$parpath= $_GET['parentpath'];
$mainpath= $_GET['mainpath'];
unset($_GET['mainpath']);
unset($_GET['parentpath']);
unset($_GET['id']); 
?>
<div style='position:absolute;top:0;width:100%;height:100%;left:0;z-index:9999;background:#555;opacity:0.5;color:#000;'></div>
<?php /*<div style="width: 58px; margin-left: 46%; margin-top: 31%; opacity: 1;">
  <a style="width: 58px;color: rgb(0, 0, 0);padding: 13px; background: none repeat scroll 0% 0% rgb(255, 255, 255);" href="javascript:void(0)" onclick="show_org('<?php echo $btr ?>','<?php echo $parpath ?>','<?php echo $mainpath ?>')">Continue</a>
</div> */?>
<div style="width: 58px; opacity: 1; position: absolute; z-index: 99999; left: 50%; top: 40%;">
  <a onclick="show_org('<?php echo $btr ?>','<?php echo $parpath ?>','<?php echo $mainpath ?>')" style="padding: 10px; background: none repeat scroll 0px 0px rgb(255, 255, 255); color: rgb(0, 0, 0);cursor: pointer; border: 1px solid rgb(88, 238, 26); font-size: 15px;">Continue</a>
</div>
<?php } ?>
<script>
function show_org(b,prnt,mainch) {
$url = 'http://www.samaritancitation.com/hud.php?b='+b+'&parentpath='+prnt+'&mainpath='+mainch;
window.parent.parent.parent.location = $url;
}
</script>