<?php
// $Id: block.tpl.php,v 1.2 2007/08/07 08:39:36 goba Exp $

// This line changes the default block Title of a specific block to the username of the logged user.
if ($block->bid == 110) $block->subject = $user->name;
?>
<!--
<div class="<?php print "block block-$block->module" ?>" id="<?php print "block-$block->module-$block->delta"; ?>">
    <div class="block-top png"><div></div></div>
    	<div class="bg-block png">
        	<div class="title">
                <h3><?php print $block->subject ?></h3>
            </div>
            <div class="content"><?php print $block->content ?></div>
        </div>
    <div class="block-bot png"><div></div></div>
</div>

<div id="cbblock">
	<div class="cbb">
		<h3><?php print $block->subject ?></h3>
		<div class="content"><?php print $block->content ?></div>
	</div>
</div>
-->
<?php 
	$boxclass = (!empty($block->subject) ? "jboxh" : "jbox");
?>

<div class="<?php echo $boxclass; ?>">	
	<div class="jboxhead"><h2><?php print $block->subject ?></h2></div>
	<div class="jboxbody">
		<div class="jboxcontent">
			<?php print $block->content ?>
		</div>
	</div>
	<div class="jboxfoot"><p></p></div>
</div>
<hr class="divider" style="margin:5px 0 5px 0;" />