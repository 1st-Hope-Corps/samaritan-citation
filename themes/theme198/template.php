<?php
function theme198_menu_local_task($link, $active = FALSE) {
  return '<li '. ($active ? 'class="active" ' : '') .'><span><span>'. $link ."</span></span></li>\n";
}
?>