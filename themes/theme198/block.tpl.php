<?php
// $Id: block.tpl.php,v 1.2 2007/08/07 08:39:36 goba Exp $

// This line changes the default block Title of a specific block to the username of the logged user.
if ($block->bid == 110) $block->subject = $user->name;
?>
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