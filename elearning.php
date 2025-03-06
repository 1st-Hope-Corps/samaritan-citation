<?php
$sEmailVal = (isset($_GET["u"])) ? $_GET["u"]:"";
$sPassVal = (isset($_GET["p"])) ? $_GET["p"]:"";
if(isset($_GET['id'])){
?>
<html>
	<head>
		<title>eLearning</title>
	</head>
	<?php
	if(isset($_GET['mainpath'])) {
	$fgh = $_GET['mainpath']; 
	unset($_GET['mainpath']); 
	$fgrh = $_GET['parentpath']; 
	unset($_GET['parentpath']); 
	unset($_GET['id']); 
	?>
	<iframe width="817" frameborder="0" height="100%" marginwidth="0" marginheight="0" src="scrapedcontent.php?id=help&parentpath=<?php echo $fgrh ?>&mainpath=<?php echo $fgh ?>&u=<?php echo $sEmailVal; ?>&p=<?php echo $sPassVal; ?>" style="position:relative; margin:0px auto 0; display:block;" ></iframe>
	<?php } else { ?>
	<iframe width="817" frameborder="0" height="100%" marginwidth="0" marginheight="0" src="scrapedcontent.php?id=help&u=<?php echo $sEmailVal; ?>&p=<?php echo $sPassVal; ?>" style="position:relative; margin:0px auto 0; display:block;" ></iframe>
	<?php } ?>
</html>
<?php
} else{
?>
<html>
	<head>
		<title>eLearning</title>
	</head>
	<iframe width="100%" frameborder="0" height="100%" marginwidth="0" marginheight="0" src="scrapedcontent.php?u=<?php echo $sEmailVal; ?>&p=<?php echo $sPassVal; ?>" style="position:relative; margin:0px auto 0; display:block;" ></iframe>
</html>
<?php } ?>