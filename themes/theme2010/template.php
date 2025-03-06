<?php

function theme2010_menu_local_task($link, $active = FALSE) {
   $dom = new DomDocument();
   @$dom->loadHTML($link);
   $urls = $dom->getElementsByTagName('a');

   foreach ($urls as $url) {
        $attributes = $url->attributes;                   
        $sNodevalue = $url->nodeValue;
   }
   if($sNodevalue !== ''):
   return '<li '. ($active ? 'class="active" ' : '') .'><span><span>'.$link."</span></span></li>\n";     
   endif;
}

?>